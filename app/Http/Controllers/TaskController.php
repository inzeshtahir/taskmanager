<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Task;
use Carbon\Carbon;

class TaskController extends Controller
{
    public function index(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Please log in to view your tasks.');
        }

        $query = Task::where('user_id', Auth::id());

        // 🔍 Apply search filter
        if ($request->has('search') && $request->search !== null) {
            $searchTerm = $request->search;
            $query->where(function ($q) use ($searchTerm) {
                $q->where('name', 'like', '%' . $searchTerm . '%')
                  ->orWhere('description', 'like', '%' . $searchTerm . '%');
            });
        }

        // 📅 Apply date filters
        $filter = $request->query('filter');
        if ($filter === 'today') {
            $query->whereDate('created_at', Carbon::today());
        } elseif ($filter === 'week') {
            $query->whereBetween('created_at', [
                Carbon::now()->startOfWeek(Carbon::MONDAY),
                Carbon::now()->endOfWeek(Carbon::SUNDAY)
            ]);
        }

        $tasks = $query->orderBy('created_at', 'desc')->get();

        return view('tasks.index', compact('tasks'));
    }

    public function create()
    {
        return view('tasks.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'status' => 'required|in:Pending,Completed,Overdue',
            'due_date' => 'required|date',
            'priority' => 'required|in:Low,Medium,High',
        ]);

        Task::create([
            'name' => $request->name,
            'status' => $request->status,
            'due_date' => $request->due_date ?? now()->toDateString(),
            'priority' => $request->priority,
            'user_id' => Auth::id(),
            'position' => Task::where('user_id', Auth::id())->max('position') + 1,
        ]);

        return redirect()->route('tasks.index')->with('success', 'Task created successfully.');
    }

    public function edit(Task $task)
    {
        if ($task->user_id !== Auth::id()) {
            return redirect()->route('tasks.index')->with('error', 'Unauthorized');
        }

        return view('tasks.edit', compact('task'));
    }

    public function update(Request $request, Task $task)
    {
        if ($task->user_id !== Auth::id()) {
            return redirect()->route('tasks.index')->with('error', 'Unauthorized');
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'status' => 'required|in:Pending,Completed,Overdue',
            'due_date' => 'nullable|date',
            'priority' => 'required|in:Low,Medium,High',
        ]);

        $task->update([
            'name' => $request->name,
            'status' => $request->status,
            'due_date' => $request->due_date,
            'priority' => $request->priority,
        ]);

        return redirect()->route('tasks.index')->with('success', 'Task updated successfully.');
    }

    public function destroy(Task $task)
    {
        if ($task->user_id !== Auth::id()) {
            return redirect()->route('tasks.index')->with('error', 'Unauthorized');
        }

        $task->delete();

        return redirect()->route('tasks.index')->with('success', 'Task deleted successfully.');
    }

    public function markCompleted(Task $task)
    {
        if ($task->user_id !== Auth::id()) {
            return redirect()->route('tasks.index')->with('error', 'Unauthorized');
        }

        $task->update(['status' => 'Completed']);

        return redirect()->route('tasks.index')->with('success', 'Task marked as completed.');
    }

    public function show(Task $task)
    {
        if ($task->user_id !== Auth::id()) {
            return redirect()->route('tasks.index')->with('error', 'Unauthorized');
        }

        return view('tasks.show', compact('task'));
    }
    public function searchSuggestions(Request $request)
{
    $keyword = $request->input('query');

    $tasks = Task::where('user_id', Auth::id())
        ->where('name', 'like', '%' . $keyword . '%')
        ->limit(5)
        ->get();

    return response()->json($tasks);
}

}

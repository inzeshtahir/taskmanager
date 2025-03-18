<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log; // ✅ Import Log
use App\Models\Task;

class TaskController extends Controller
{
    public function store(Request $request)
    {
        // Ensure user is logged in before storing a task
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'You must be logged in to add tasks.');
        }

        // Get authenticated user ID
        $userId = Auth::id();

        // If user ID is null, prevent insertion
        if (!$userId) {
            return redirect()->route('login')->with('error', 'User authentication failed. Please log in again.');
        }

        // ✅ Debugging: Log user ID to confirm it's set
        Log::info('User ID when creating task:', ['user_id' => $userId]);

        // Validate input
        $request->validate([
            'name' => 'required|string|max:255',
            'status' => 'required|in:Pending,Completed,Overdue',
        ]);

        // Create the task
        Task::create([
            'name' => $request->name,
            'status' => $request->status,
            'user_id' => $userId, // ✅ Ensure this is NOT NULL
        ]);

        return redirect()->route('tasks.index')->with('success', 'Task created successfully.');
    }
}

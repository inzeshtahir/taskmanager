@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap">
        <h2 class="fw-bold text-primary mb-2">Your Tasks</h2>
        <div class="d-flex flex-wrap gap-2">
            <a href="{{ route('tasks.create') }}" class="btn btn-success">+ Add Task</a>
            <div class="btn-group">
                <a href="{{ route('tasks.index') }}" class="btn btn-outline-secondary btn-sm">All</a>
                <a href="{{ route('tasks.index', ['filter' => 'today']) }}" class="btn btn-outline-primary btn-sm">Today</a>
                <a href="{{ route('tasks.index', ['filter' => 'week']) }}" class="btn btn-outline-info btn-sm">This Week</a>
            </div>
        </div>
    </div>

    @if ($tasks->count())
        <div class="row row-cols-1 g-4">
            @foreach ($tasks as $task)
                @php
                    $dueSoon = $task->due_date && \Carbon\Carbon::parse($task->due_date)->diffInHours(now()) <= 24;
                @endphp

                <div class="col">
                    <div class="card shadow-sm border-start border-4 border-{{ 
                        $task->status === 'Completed' ? 'success' : 
                        ($task->status === 'Pending' ? 'warning' : 'danger') 
                    }}">
                        <div class="card-body">
                            <h5 class="card-title d-flex justify-content-between align-items-center">
                                <span>{{ $task->name }}</span>
                                <span class="badge 
                                    @if($task->status === 'Completed') bg-success
                                    @elseif($task->status === 'Pending') bg-warning
                                    @else bg-danger
                                    @endif">
                                    {{ ucfirst($task->status) }}
                                </span>
                                <div class="d-flex">
                                    <a href="{{ route('tasks.edit', $task->id) }}" class="btn btn-sm btn-outline-secondary me-2">Edit</a>
                                    <form action="{{ route('tasks.destroy', $task->id) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <button class="btn btn-outline-success btn-sm">✔ Done</button>
                                    </form>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                @else
                    <div class="alert alert-info">No tasks found. <a href="{{ route('tasks.create') }}">Create one</a>.</div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection

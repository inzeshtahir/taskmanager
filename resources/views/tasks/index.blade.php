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
                                @if ($dueSoon && $task->status !== 'Completed')
                                    <span class="badge bg-danger">⏰ Due Soon</span>
                                @endif
                            </h5>

                            <p class="mb-1 text-muted">
                                <strong>Due:</strong> {{ $task->due_date ? \Carbon\Carbon::parse($task->due_date)->format('M d, Y') : 'N/A' }}
                            </p>

                            @if ($task->description)
                                <p>{{ $task->description }}</p>
                            @endif

                            @if ($task->photo)
                                <img src="{{ asset('storage/' . $task->photo) }}" class="img-fluid rounded mb-2" style="max-height: 150px;">
                            @endif

                            <div class="mb-3">
                                <span class="badge bg-secondary me-2">{{ $task->priority }}</span>
                                <span class="badge bg-{{ 
                                    $task->status === 'Completed' ? 'success' : 
                                    ($task->status === 'Pending' ? 'warning' : 'danger') 
                                }}">{{ $task->status }}</span>
                            </div>

                            @if ($task->subtasks->count())
                                <ul class="list-group list-group-flush mb-3">
                                    @foreach ($task->subtasks as $sub)
                                        <li class="list-group-item">
                                            <input type="checkbox" disabled {{ $sub->is_done ? 'checked' : '' }}> {{ $sub->title }}
                                        </li>
                                    @endforeach
                                </ul>
                            @endif

                            {{-- Action Buttons --}}
                            <div class="d-flex flex-wrap gap-2">
                                @if ($task->status !== 'Completed')
                                    <form action="{{ route('tasks.markCompleted', $task->id) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <button class="btn btn-outline-success btn-sm">✔ Done</button>
                                    </form>
                                @endif

                                <a href="{{ route('tasks.edit', $task->id) }}" class="btn btn-outline-secondary btn-sm">Edit</a>

                                <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" onsubmit="return confirm('Are you sure?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-outline-danger btn-sm">Delete</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="alert alert-info text-center">
            You have no tasks yet. <a href="{{ route('tasks.create') }}" class="alert-link">Create one</a>.
        </div>
    @endif
</div>
@endsection

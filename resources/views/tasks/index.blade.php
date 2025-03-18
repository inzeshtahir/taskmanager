@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="task-list p-4 bg-white rounded shadow">
                <h3 class="mb-3">Your Tasks</h3>

                <a href="{{ route('tasks.create') }}" class="btn btn-primary mb-3">Add Task</a>

                @if(isset($tasks) && $tasks->isNotEmpty()) 
                    <ul class="list-group">
                        @foreach ($tasks as $task)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
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
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
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

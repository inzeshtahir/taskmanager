@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4">{{ $task->name }}</h2>

    <div class="card p-4 shadow">
        <p><strong>Status:</strong> {{ $task->status }}</p>
        <p><strong>Due Date:</strong> {{ $task->due_date ?? 'N/A' }}</p>
        <p><strong>Priority:</strong> {{ $task->priority }}</p>

        @if ($task->description)
            <p><strong>Description:</strong> {{ $task->description }}</p>
        @endif

        @if ($task->photo)
            <div class="mb-3">
                <img src="{{ asset('storage/' . $task->photo) }}" class="img-fluid rounded" alt="Task Photo">
            </div>
        @endif

        <a href="{{ route('tasks.edit', $task->id) }}" class="btn btn-warning">Edit</a>
        <a href="{{ route('tasks.index') }}" class="btn btn-secondary">Back to Tasks</a>
    </div>
</div>
@endsection

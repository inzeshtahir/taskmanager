@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="card shadow-sm p-4">
        <h2 class="mb-4">Edit Task</h2>

        @if ($errors->any())
        <div class="alert alert-danger">
            <strong>There were some problems:</strong>
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form method="POST" action="{{ route('tasks.update', $task->id) }}" enctype="multipart/form-data">
            @csrf
            @method('PATCH')

            <div class="mb-3">
                <label for="name" class="form-label">Task Name</label>
                <input type="text" name="name" value="{{ old('name', $task->name) }}" id="name" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea name="description" id="description" class="form-control" rows="3">{{ old('description', $task->description) }}</textarea>
            </div>

            <div class="mb-3">
                <label for="photo" class="form-label">Replace Photo</label><br>
                @if ($task->photo)
                <img src="{{ asset('storage/' . $task->photo) }}" class="img-fluid mb-2 rounded" style="max-height: 150px;">
                @endif
                <input type="file" name="photo" id="photo" class="form-control">
            </div>

            <div class="mb-3">
                <label for="priority" class="form-label">Priority</label>
                <select name="priority" id="priority" class="form-select">
                    <option value="Low" {{ $task->priority == 'Low' ? 'selected' : '' }}>Low</option>
                    <option value="Medium" {{ $task->priority == 'Medium' ? 'selected' : '' }}>Medium</option>
                    <option value="High" {{ $task->priority == 'High' ? 'selected' : '' }}>High</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="status" class="form-label">Status</label>
                <select name="status" id="status" class="form-select">
                    <option value="Pending" {{ $task->status == 'Pending' ? 'selected' : '' }}>Pending</option>
                    <option value="Completed" {{ $task->status == 'Completed' ? 'selected' : '' }}>Completed</option>
                    <option value="Overdue" {{ $task->status == 'Overdue' ? 'selected' : '' }}>Overdue</option>
                </select>
            </div>

    </div>


    @if ($task->subtasks && $task->subtasks->count())
    <div class="mb-3">
        <label class="form-label">Subtasks</label>
        <ul class="list-group">
            @foreach ($task->subtasks as $subtask)
            <li class="list-group-item">
                <input type="checkbox" disabled {{ $subtask->is_done ? 'checked' : '' }}> {{ $subtask->title }}
            </li>
            @endforeach
        </ul>
    </div>
    @endif

    <button type="submit" class="btn btn-success">Update Task</button>
    <a href="{{ route('tasks.index') }}" class="btn btn-secondary ms-2">Cancel</a>
    </form>
</div>
</div>
@endsection
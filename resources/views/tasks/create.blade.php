@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="card shadow-sm p-4">
        <h2 class="mb-4">Create New Task</h2>

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

        <form method="POST" action="{{ route('tasks.store') }}" enctype="multipart/form-data">
    @csrf

    <div class="mb-3">
        <label for="name" class="form-label">Task Name</label>
        <input type="text" name="name" id="name" class="form-control" required>
    </div>

    <div class="mb-3">
        <label for="description" class="form-label">Description</label>
        <textarea name="description" id="description" class="form-control"></textarea>
    </div>

    <div class="mb-3">
        <label for="photo" class="form-label">Attach Photo</label>
        <input type="file" name="photo" id="photo" class="form-control">
    </div>

    <div class="mb-3">
        <label for="due_date" class="form-label">Due Date</label>
        <input type="date" name="due_date" id="due_date" class="form-control">
    </div>

    <div class="mb-3">
        <label for="priority" class="form-label">Priority</label>
        <select name="priority" id="priority" class="form-control" required>
            <option value="Low">Low</option>
            <option value="Medium" selected>Medium</option>
            <option value="High">High</option>
        </select>
    </div>

  
    <div class="mb-3">
        <label for="status" class="form-label">Status</label>
        <select name="status" id="status" class="form-control" required>
            <option value="Pending">Pending</option>
            <option value="Completed">Completed</option>
            <option value="Overdue">Overdue</option>
        </select>
    </div>

    <button type="submit" class="btn btn-success">Create Task</button>
</form>

<script>
    function addSubtask() {
        const container = document.getElementById('subtask-container');
        const div = document.createElement('div');
        div.className = 'd-flex mb-2';
        div.innerHTML = `
            <input type="text" name="subtasks[]" class="form-control me-2" placeholder="Subtask title">
            <button type="button" class="btn btn-outline-danger" onclick="this.parentNode.remove()">−</button>
        `;
        container.appendChild(div);
    }
    <div class="mb-3">
    <label for="status" class="form-label">Status</label>
    <select name="status" class="form-control" required>
        <option value="">-- Select Status --</option>
        <option value="Pending">Pending</option>
        <option value="Completed">Completed</option>
        <option value="Overdue">Overdue</option>
    </select>
    @error('status')
        <small class="text-danger">{{ $message }}</small>
    @enderror
</div>


</script>
@endsection

@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="p-4 bg-white rounded shadow">
                <h3 class="mb-3">Create New Task</h3>

                <form action="{{ route('tasks.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">Task Name</label>
                        <input type="text" name="name" id="name" 
class="form-control" required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="status" class="form-label">Status</label>
                        <select name="status" id="status" class="form-control" 
required>
                            <option value="Pending">Pending</option>
                            <option value="Completed">Completed</option>
                            <option value="Overdue">Overdue</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-success">Save 
Task</button>
                    <a href="{{ route('tasks.index') }}" class="btn 
btn-secondary">Cancel</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection



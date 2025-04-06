<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = ['list_id', 'name', 'due_date', 'priority', 'status', 'user_id'];

    // Define the relationship with TaskList
    public function taskList() // ✅ Changed from list() to taskList() to avoid conflicts
    {
        return $this->belongsTo(TaskList::class, 'list_id');
    }
    public function list() {
        return $this->belongsTo(TaskList::class, 'task_list_id');
    }
    public function subtasks()
{
    return $this->hasMany(Subtask::class);
}

}

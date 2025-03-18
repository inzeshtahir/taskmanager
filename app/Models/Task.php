<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = ['list_id', 'name', 'due_date', 'priority', 'status'];

    // Define the relationship with TaskList
    public function taskList() // ✅ Changed from list() to taskList() to avoid conflicts
    {
        return $this->belongsTo(TaskList::class, 'list_id');
    }
}

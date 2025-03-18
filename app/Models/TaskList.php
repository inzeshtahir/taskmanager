<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaskList extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'name', 'color'];

    // Relationship with tasks
    public function tasks()
    {
        return $this->hasMany(Task::class);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TaskController extends Controller
{
    // Show the Task Manager homepage
    public function index()
    {
        return view('tasks.index');  // Ensure this matches the correct view path
    }

    // Show the Task Manager dashboard
    public function dashboard()
    {
        return view('tasks.dashboard');  // Ensure this view exists as well
    }
}

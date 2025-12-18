<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task; // This must be at the top with other "use" statements

class TaskController extends Controller
{
    public function index() 
    {
        // This is now INSIDE the class
        $tasks = Task::all(); 
        return view('tasks', compact('tasks')); 
    }
}
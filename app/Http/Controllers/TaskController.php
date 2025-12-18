<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task; // MUST be inside the namespace area

class TaskController extends Controller
{
    public function index() {
        $tasks = Task::all(); 
        return view('tasks', compact('tasks')); 
    }

    public function store(Request $request) {
        Task::create([
            'title' => $request->title,
            'is_completed' => false
        ]);
        return redirect('/');
    }
}
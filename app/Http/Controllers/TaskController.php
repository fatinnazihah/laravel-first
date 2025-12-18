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
        // Validate the request
        $request->validate([
            'title' => 'required',
            'attachment' => 'nullable|file|mimes:jpg,jpeg,png,mp4,mov|max:20000', // max 20MB
        ]);

        $path = null;
        if ($request->hasFile('attachment')) {
            // Saves file in storage/app/public/uploads
            $path = $request->file('attachment')->store('uploads', 'public');
        }

        Task::create([
            'title' => $request->title,
            'description' => $request->description,
            'attachment' => $path,
        ]);

        return redirect('/');
    }

    public function like($id) {
        $post = Task::find($id);
        $post->increment('likes'); // Adds 1 to the current count
        return redirect()->back();
    }

    // Show the edit form
    public function edit($id) {
        $post = Task::findOrFail($id);
        return view('edit', compact('post'));
    }

    // Save the updated post
    public function update(Request $request, $id) {
        $post = Task::findOrFail($id);
        $post->update([
            'title' => $request->title,
            'description' => $request->description,
        ]);
        return redirect('/')->with('success', 'Post updated!');
    }

    // Delete the post
    public function destroy($id) {
        $post = Task::findOrFail($id);
        $post->delete();
        return redirect('/')->with('success', 'Post deleted!');
    }
}
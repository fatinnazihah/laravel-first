<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;

// Change this line:
Route::get('/', [TaskController::class, 'index']);
Route::post('/tasks', [TaskController::class, 'store']); 
Route::post('/post/{id}/like', [TaskController::class, 'like']);
Route::get('/post/{id}/edit', [TaskController::class, 'edit']);
Route::put('/post/{id}', [TaskController::class, 'update']);
Route::delete('/post/{id}', [TaskController::class, 'destroy']);
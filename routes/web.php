<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;

// Change this line:
Route::get('/', [TaskController::class, 'index']);
Route::post('/tasks', [TaskController::class, 'store']); 
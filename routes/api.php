<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\SubtaskController;
use App\Http\Controllers\WelcomeController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::get('/', [WelcomeController::class, 'index']);

Route::apiResource('tasks', TaskController::class);
Route::get('ongoing-tasks', [TaskController::class, 'ongoingTasks']);
Route::get('completed-tasks', [TaskController::class, 'completedTasks']);
Route::post('tasks/{task}/toggle-complete', [TaskController::class, 'toggleComplete']);

Route::post('tasks/{task}/subtasks', [SubtaskController::class, 'store']);
Route::put('tasks/{task}/subtasks/{subtask}', [SubtaskController::class, 'update']);
Route::delete('tasks/{task}/subtasks/{subtask}', [SubtaskController::class, 'destroy']);
Route::post('tasks/{task}/subtasks/{subtask}/toggle-complete', [SubtaskController::class, 'toggleComplete']);
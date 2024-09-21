<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    use ApiResponse;

    public function index()
    {
        $tasks = Task::with('subtasks')->get();
        return $this->successResponse($tasks, 'Tasks retrieved successfully');
    }

    public function store(Request $request)
    {
        $request->validate([
            'text' => 'required|string|max:255',
            'deadline' => 'nullable|date',
        ]);

        $task = Task::create($request->all());
        return $this->successResponse($task, 'Task created successfully', 201);
    }

    public function show(Task $task)
    {
        return $this->successResponse($task->load('subtasks'), 'Task retrieved successfully');
    }

    public function update(Request $request, Task $task)
    {
        $request->validate([
            'text' => 'string|max:255',
            'completed' => 'boolean',
            'deadline' => 'nullable|date',
        ]);

        $task->update($request->all());
        return $this->successResponse($task, 'Task updated successfully');
    }

    public function destroy(Task $task)
    {
        $task->delete();
        return $this->successResponse(null, 'Task deleted successfully', 204);
    }

    public function ongoingTasks()
    {
        $tasks = Task::where('completed', false)->with('subtasks')->get();
        return $this->successResponse($tasks, 'Ongoing tasks retrieved successfully');
    }

    public function completedTasks()
    {
        $tasks = Task::where('completed', true)->with('subtasks')->get();
        return $this->successResponse($tasks, 'Completed tasks retrieved successfully');
    }

    public function toggleComplete(Task $task)
    {
        $task->completed = !$task->completed;
        $task->save();
        return $this->successResponse($task, 'Task completion status toggled successfully');
    }
}
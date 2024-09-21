<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Subtask;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

class SubtaskController extends Controller
{
    use ApiResponse;

    public function store(Request $request, Task $task)
    {
        $request->validate([
            'text' => 'required|string|max:255',
        ]);

        $subtask = $task->subtasks()->create($request->all());
        return $this->successResponse($subtask, 'Subtask created successfully', 201);
    }

    public function update(Request $request, Task $task, Subtask $subtask)
    {
        $request->validate([
            'text' => 'string|max:255',
            'completed' => 'boolean',
        ]);

        $subtask->update($request->all());
        return $this->successResponse($subtask, 'Subtask updated successfully');
    }

    public function destroy(Task $task, Subtask $subtask)
    {
        $subtask->delete();
        return $this->successResponse(null, 'Subtask deleted successfully', 204);
    }

    public function toggleComplete(Task $task, Subtask $subtask)
    {
        $subtask->completed = !$subtask->completed;
        $subtask->save();

        if ($task->subtasks()->where('completed', false)->count() === 0) {
            $task->completed = true;
            $task->save();
        }

        return $this->successResponse($subtask, 'Subtask completion status toggled successfully');
    }
}
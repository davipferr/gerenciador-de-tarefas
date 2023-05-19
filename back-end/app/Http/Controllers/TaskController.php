<?php

namespace App\Http\TaskController;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Task;
use App\Enums\Task\TaskStatus;

class TaskController extends Controller
{

    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string',
            'description' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors(),
            ], 400);
        }

        $taskData = [
            'title' => $request->title,
            'description' => $request->description,
            'completed' => TaskStatus::PENDING,
        ];

        Task::create($taskData);

        return response()->json([
            'message' => 'Task created successfully'
        ]);
    }

    public function list()
    {
        $tasks = Task::all(['title', 'description', 'completed']);

        return response()->json($tasks);
    }

    public function update(Request $request, $id)
    {
        $task = Task::find($id);

        if (!$task) {
            return response()->json([
                'message' => 'Task not found'
            ], 404);
        }

        $validatedData = Validator::make($request->all(), [
            'title' => 'sometimes|required|string',
            'description' => 'sometimes|required|string',
            'completed' => 'sometimes|required|boolean',
        ]);

        if ($validatedData->fails()) {
            return response()->json([
                'message' => $validatedData->errors(),
            ], 400);
        }

        $task->update($validatedData);

        return response()->json([
            'message' => 'Task updated'
        ]);
    }

    public function delete($id)
    {
        $task = Task::find($id);

        if (!$task) {
            return response()->json(['message' => 'Task not found'], 404);
        }

        $task->delete();
        return response()->json(['message' => 'Task deleted']);
    }
}

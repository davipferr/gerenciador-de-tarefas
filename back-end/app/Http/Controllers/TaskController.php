<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Task;
use App\Enums\TaskStatus;
use Illuminate\Http\Response;

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
        $tasks = Task::all(['id','title', 'description', 'completed']);

        return response()->json($tasks, Response::HTTP_OK);
    }

    public function update(Request $request, $id)
    {
        // get the data of the table with the same id send by the user
        $task = Task::find($id);

        if (!$task) {
            return response()->json([
                'message' => 'Task not found'
            ], 404);
        }

        $validatedData = Validator::make($request->all(), [
            'newStatus' => 'required|in:' . TaskStatus::CONCLUDED . ',' . TaskStatus::PENDING,
        ]);

        if ($validatedData->fails()) {
            return response()->json([
                'message' => $validatedData->errors(),
            ], 400);
        }

        // Now i have to update the column completed with the value of newStatus
        $task->update([
            'completed' => $request->newStatus
        ]);

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

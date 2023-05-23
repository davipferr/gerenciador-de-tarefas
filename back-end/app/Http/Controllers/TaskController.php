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
            'message' => 'Tarefa criada com sucesso'
        ]);
    }

    public function list()
    {
        $tasks = Task::all(['id','title', 'description', 'completed']);

        if (!$tasks) {
            return response()->json(['message' => 'Nehuma Tarefa foi encontrada'], Response::HTTP_NOT_FOUND);
        }

        return response()->json($tasks, Response::HTTP_OK);
    }

    public function taskDetails($taskId)
    {
        $taskData = Task::find($taskId, ['id', 'title', 'description', 'completed']);

        if (!$taskData) {
            return response()->json(['message' => 'Nehuma Tarefa foi encontrada'], Response::HTTP_NOT_FOUND);
        }

        return response()->json($taskData, Response::HTTP_OK);
    }

    public function update(Request $request, $id)
    {
        $task = Task::find($id);

        if (!$task) {
            return response()->json([
                'message' => 'Nehuma Tarefa foi encontrada'
            ], 404);
        }

        $validatedData = Validator::make($request->all(), [
            'newTitle' => 'nullable|string',
            'newDescription' => 'nullable|string',
            'newStatus' => 'nullable|in:' . TaskStatus::CONCLUDED . ',' . TaskStatus::PENDING,
        ]);

        if ($validatedData->fails()) {
            return response()->json([
                'message' => $validatedData->errors(),
            ], 400);
        }

        $updateData = array_filter([
            'title' => $request->newTitle,
            'description' => $request->newDescription,
            'completed' => $request->newStatus,
        ], function ($value) {
            return $value !== null;
        });

        $task->update($updateData);

        return response()->json([
            'message' => 'Tarefa atualizada com sucesso'
        ]);
    }

    public function delete($id)
    {
        $task = Task::find($id);

        if (!$task) {
            return response()->json(['message' => 'Nehuma Tarefa foi encontrada'], 404);
        }

        $task->delete();
        return response()->json(['message' => 'Tarefa deletada com sucesso']);
    }
}

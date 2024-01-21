<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Carbon\Carbon;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = Task::all();

        return response()->json($tasks);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'subject' => 'required|string',
            'task_title' => 'required|string',
            'professor' => 'required|string',
            'description' => 'nullable|string',
            'deadline' => 'required|date',
            'completed_at' => 'nullable|date',
            'status' => 'required|integer|in:0,1,2,3',
        ]);

        // Use Carbon to create Carbon instances for date fields
        $validatedData['deadline'] = Carbon::parse($validatedData['deadline']);
        $validatedData['completed_at'] = $validatedData['completed_at'] ? Carbon::parse($validatedData['completed_at']) : null;

        $task = Task::create($validatedData);

        return response()->json(['success' => 'Task created successfully'], 201);
    }

    public function show($id)
    {
        $task = Task::findOrFail($id);

        return response()->json(['task' => $task]);
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'subject' => 'required|string',
            'task_title' => 'required|string',
            'professor' => 'required|string',
            'description' => 'nullable|string',
            'deadline' => 'required|date',
            'completed_at' => 'nullable|date',
            'status' => 'required|integer|in:0,1,2,3',
        ]);

        $task = Task::findOrFail($id);


        $validatedData['deadline'] = Carbon::parse($validatedData['deadline']);
        $validatedData['completed_at'] = $validatedData['completed_at'] ? Carbon::parse($validatedData['completed_at']) : null;

        $task->update($validatedData);

        return response()->json(['success' => 'Task updated successfully'], 200);
    }

    public function destroy($id)
    {
        $task = Task::find($id);

        if ($task) {
            $task->delete();
            return response()->json(['success' => 'Task deleted successfully']);
        }

        return response()->json(['success' => 'Task not found, but operation completed']);
    }
}
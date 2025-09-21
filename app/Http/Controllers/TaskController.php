<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tasks = Task::paginate(10);
        return view('tasks.index', compact('tasks'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (!auth()->user()->can('create tasks')) {
            abort(403);
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'project_id' => 'required|exists:projects,id',
            'status' => 'nullable|in:pending,in_progress,completed',
            'due_date' => 'nullable|date|after_or_equal:today',
        ]);

        Task::create([
            'title' => $request->title,
            'description' => $request->description,
            'project_id' => $request->project_id,
            'status' => $request->status ?? 'pending',
            'due_date' => $request->due_date,
            'created_by' => auth()->id(),
        ]);

        return redirect()->back()->with('success', 'Task created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $task = Task::findOrFail($id);
        return view('tasks.show', compact('task'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        if (!auth()->user()->can('edit tasks')) {
            abort(403);
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'project_id' => 'required|exists:projects,id',
            'status' => 'nullable|in:pending,in_progress,completed',
            'due_date' => 'nullable|date|after_or_equal:today',
        ]);

        $task = Task::findOrFail($id);
        $task->update([
            'title' => $request->title,
            'description' => $request->description,
            'project_id' => $request->project_id,
            'status' => $request->status,
            'due_date' => $request->due_date,
        ]);

        return redirect()->back()->with('success', 'Task updated successfully.');
    }

    /**
     * Update the status of the specified resource.
     */

    public function updateStatus(Request $request, string $id)
    {
        if (!auth()->user()->can('edit tasks')) {
            abort(403);
        }

        $request->validate([
            'status' => 'required|in:pending,in_progress,completed',
        ]);

        $task = Task::findOrFail($id);
        $task->update([
            'status' => $request->status,
        ]);

        return redirect()->back()->with('success', 'Task status updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if (!auth()->user()->can('delete tasks')) {
            abort(403);
        }

        $task = Task::findOrFail($id);
        $task->delete();

        return redirect()->back()->with('success', 'Task deleted successfully.');
    }
}

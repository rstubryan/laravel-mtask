<?php

namespace App\Http\Controllers;

use App\Models\GroupTask;
use Illuminate\Http\Request;

class GroupTaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $groupTasks = GroupTask::paginate(9);
        return view('grouptasks.index', compact('groupTasks'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (!auth()->user()->can('create grouptasks')) {
            abort(403);
        }

        $request->validate([
            'group_id' => 'required|exists:groups,id',
            'task_id' => 'required|array',
            'task_id.*' => 'exists:tasks,id',
        ]);

        foreach ($request->task_id as $taskId) {
            GroupTask::create([
                'group_id' => $request->group_id,
                'task_id' => $taskId,
            ]);
        }

        return redirect()->back()->with('success', 'GroupTasks created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        if (!auth()->user()->can('view grouptasks')) {
            abort(403);
        }

        $groupTask = GroupTask::with(['group', 'task'])->findOrFail($id);
        return view('grouptasks.show', compact('groupTask'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        if (!auth()->user()->can('edit grouptasks')) {
            abort(403);
        }

        $request->validate([
            'group_id' => 'required|exists:groups,id',
            'task_id' => 'required|array',
            'task_id.*' => 'exists:tasks,id',
        ]);

        GroupTask::where('group_id', $request->group_id)->delete();

        foreach ($request->task_id as $taskId) {
            GroupTask::create([
                'group_id' => $request->group_id,
                'task_id' => $taskId,
            ]);
        }

        return redirect()->back()->with('success', 'GroupTasks updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if (!auth()->user()->can('delete grouptasks')) {
            abort(403);
        }

        $groupTask = GroupTask::findOrFail($id);
        $groupTask->delete();

        return redirect()->back()->with('success', 'GroupTask deleted successfully.');
    }
}

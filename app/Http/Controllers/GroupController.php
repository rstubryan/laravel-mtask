<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;

class GroupController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $groups = Group::paginate(9);
        return view('groups.index', compact('groups'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (!auth()->user()->can('create groups')) {
            abort(403);
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        Group::create($request->all());

        return redirect()->back()->with('success', 'Group created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        if (!auth()->user()->can('view groups')) {
            abort(403);
        }

        $group = Group::findOrFail($id);
        $users = User::all();
        $allTasks = Task::all();
        $tasks = $group->tasks()->paginate(9);

        return view('groups.show', compact('group', 'users', 'allTasks', 'tasks'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        if (!auth()->user()->can('edit groups')) {
            abort(403);
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $group = Group::findOrFail($id);
        $group->update($request->all());

        return redirect()->back()->with('success', 'Group updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if (!auth()->user()->can('delete groups')) {
            abort(403);
        }

        $group = Group::findOrFail($id);
        $group->delete();

        return redirect()->back()->with('success', 'Group deleted successfully.');
    }
}

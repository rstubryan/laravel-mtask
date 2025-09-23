<?php

namespace App\Http\Controllers;

use App\Models\Issue;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;

class IssueController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $issues = Issue::paginate(9);
        $tasks = Task::all();
        $users = User::all();
        return view('issues.index', compact('issues', 'tasks', 'users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (!auth()->user()->can('create issues')) {
            abort(403);
        }

        $request->validate([
            'task_id' => 'required|exists:tasks,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'nullable|in:open,in_progress,resolved,closed',
            'due_date' => 'nullable|date|after_or_equal:today',
            'assigned_to' => 'nullable|exists:users,id',
        ]);

        Issue::create([
            'task_id' => $request->task_id,
            'title' => $request->title,
            'description' => $request->description,
            'status' => $request->status ?? 'open',
            'due_date' => $request->due_date,
            'created_by' => auth()->id(),
            'assigned_to' => $request->assigned_to,
        ]);

        return redirect()->back()->with('success', 'Issue created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        if (!auth()->user()->can('view issues')) {
            abort(403);
        }

        $issue = Issue::findOrFail($id);
        $tasks = Task::all();
        $users = User::all();
        return view('issues.show', compact('issue', 'tasks', 'users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        if (!auth()->user()->can('edit issues')) {
            abort(403);
        }

        $request->validate([
            'task_id' => 'required|exists:tasks,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'nullable|in:open,in_progress,resolved,closed',
            'due_date' => 'nullable|date|after_or_equal:today',
            'assigned_to' => 'nullable|exists:users,id',
        ]);

        $issue = Issue::findOrFail($id);
        $issue->update([
            'task_id' => $request->task_id,
            'title' => $request->title,
            'description' => $request->description,
            'status' => $request->status ?? 'open',
            'due_date' => $request->due_date,
            'created_by' => auth()->id(),
            'assigned_to' => $request->assigned_to,
        ]);

        return redirect()->back()->with('success', 'Issue updated successfully.');
    }

    /**
     * Update the status of the specified resource in storage.
     */
    public function updateStatus(Request $request, string $id)
    {
        if (!auth()->user()->can('edit issues')) {
            abort(403);
        }

        $request->validate([
            'status' => 'required|in:open,in_progress,resolved,closed',
        ]);

        $issue = Issue::findOrFail($id);
        $issue->update(['status' => $request->status]);

        return redirect()->back()->with('success', 'Issue status updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if (!auth()->user()->can('delete issues')) {
            abort(403);
        }

        $issue = Issue::findOrFail($id);
        $issue->delete();

        return redirect()->back()->with('success', 'Issue deleted successfully.');
    }
}

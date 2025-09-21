<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projects = Project::paginate(10);
        return view('projects.index', compact('projects'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (!auth()->user()->can('create projects')) {
            abort(403);
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        Project::create([
            'name' => $request->name,
            'description' => $request->description,
            'created_by' => auth()->id(),
        ]);

        return redirect()->route('projects.index')->with('success', 'Project created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $project = Project::findOrFail($id);
        return view('projects.show', compact('project'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $project = Project::findOrFail($id);
        $project->update([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        return redirect()->route('projects.show', $project->id)->with('success', 'Project updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if (!auth()->user()->can('delete projects')) {
            abort(403);
        }

        $project = Project::findOrFail($id);
        $project->delete();

        return redirect()->route('projects.index')->with('success', 'Project deleted successfully.');
    }
}

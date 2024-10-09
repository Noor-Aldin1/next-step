<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;

use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{
    /**
     * Display a listing of the projects.
     */
    public function index()
    {
        // Get all projects for the authenticated user
        $projects = Project::where('user_id', Auth::id())->get();

        // Return the view with the projects
        return view('user.pages.profile.partials.Projects.index_form_Projects', compact('projects'));
    }

    /**
     * Show the form for creating a new project.
     */
    public function create()
    {
        return view('projects.create');
    }

    /**
     * Store a newly created project in storage.
     */
    public function store(Request $request)
    {
        // Validate the form data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'start_due' => 'required|date',
            'end_due' => 'nullable|date|after_or_equal:start_due',
        ]);

        // Create a new project for the authenticated user
        Project::create([
            'user_id' => Auth::id(),
            'name' => $validatedData['name'],
            'description' => $validatedData['description'] ?? null,
            'start_due' => $validatedData['start_due'],
            'end_due' => $validatedData['end_due'] ?? null,
        ]);

        return redirect()->route('profile.edit')->with('success', 'Project created successfully.');
    }

    /**
     * Show the form for editing the specified project.
     */
    public function edit(Project $project)
    {
        // Check if the user owns this project
        if ($project->user_id != Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        return view('projects.edit', compact('project'));
    }

    /**
     * Update the specified project in storage.
     */
    public function update(Request $request, Project $project)
    {
        // Check if the user owns this project
        if ($project->user_id != Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        // Validate the form data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'start_due' => 'required|date',
            'end_due' => 'nullable|date|after_or_equal:start_due',
        ]);

        // Update the project
        $project->update([
            'name' => $validatedData['name'],
            'description' => $validatedData['description'] ?? null,
            'start_due' => $validatedData['start_due'],
            'end_due' => $validatedData['end_due'] ?? null,
        ]);

        return redirect()->route('profile.edit')->with('success', 'Project updated successfully.');
    }

    /**
     * Remove the specified project from storage.
     */
    public function destroy(Project $project)
    {
        // Check if the user owns this project
        if ($project->user_id != Auth::id()) {
            return response()->json(['success' => false, 'message' => 'Unauthorized action.'], 403);
        }

        // Delete the project
        $project->delete();

        // Return a JSON response
        return response()->json(['success' => true, 'message' => 'Project deleted successfully.']);
    }
}
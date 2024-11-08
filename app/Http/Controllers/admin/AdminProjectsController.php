<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;

class AdminProjectsController extends Controller
{
    // Store a newly created project in the database
    public function store(Request $request)
    {
        // Validate incoming request data
        $validated = $request->validate([
            'user_id'      => 'required|exists:users,id',  // Ensure the user exists
            'name'         => 'required|string|max:255',
            'description'  => 'nullable|string',
            'start_due'    => 'required|date',
            'end_due'      => 'nullable|date|after:start_due',  // Ensure end date is after start date, if provided
        ]);

        // Create the project
        Project::create($validated);

        // Return a response or redirect to another page
        return redirect()->back()->with('success', 'Project created successfully.');
    }

    // Update the specified project in the database
    public function update(Request $request, $id)
    {
        // Find the project by ID
        $project = Project::findOrFail($id);

        // Validate incoming request data
        $validated = $request->validate([
            'user_id'      => 'required|exists:users,id',  // Ensure the user exists
            'name'         => 'required|string|max:255',
            'description'  => 'nullable|string',
            'start_due'    => 'required|date',
            'end_due'      => 'nullable|date|after:start_due',  // Ensure end date is after start date, if provided
        ]);

        // Update the project
        $project->update($validated);

        // Return a response or redirect to another page
        return redirect()->back()->with('success', 'Project updated successfully.');
    }

    // Delete the specified project from the database
    public function destroy($id)
    {
        // Find the project by ID and delete it
        $project = Project::findOrFail($id);
        $project->delete();

        // Return a response or redirect to another page
        return response()->json(['success' => true]);
    }
}

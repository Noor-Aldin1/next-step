<?php


namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Experience;
use Illuminate\Http\Request;

class AdminExperienceController extends Controller
{
    // Store a newly created experience in the database
    public function store(Request $request)
    {
        // Validate incoming request data
        $validated = $request->validate([
            'user_id'      => 'required|exists:users,id',  // Ensure the user exists
            'position'     => 'required|string|max:255',
            'company_name' => 'required|string|max:255',
            'description'  => 'nullable|string',
            'start_due'    => 'required|date',
            'end_due'      => 'nullable|date|after:start_due',  // Ensure end date is after start date, if provided
        ]);

        // Create the experience
        Experience::create($validated);

        // Return a response, or redirect to another page
        return redirect()->back()->with('success', 'Experience created successfully.');
    }

    // Update the specified experience in the database
    public function update(Request $request, $id)
    {
        // Find the experience by ID
        $experience = Experience::findOrFail($id);

        // Validate incoming request data
        $validated = $request->validate([
            'user_id'      => 'required|exists:users,id',  // Ensure the user exists
            'position'     => 'required|string|max:255',
            'company_name' => 'required|string|max:255',
            'description'  => 'nullable|string',
            'start_due'    => 'required|date',
            'end_due'      => 'nullable|date|after:start_due',  // Ensure end date is after start date, if provided
        ]);

        // Update the experience
        $experience->update($validated);

        // Return a response, or redirect to another page
        return redirect()->back()->with('success', 'Experience updated successfully.');
    }

    // Delete the specified experience from the database
    public function destroy($id)
    {
        // Find the experience by ID and delete it
        $experience = Experience::findOrFail($id);
        $experience->delete();

        // Return a response, or redirect to another pagei
        return response()->json(['success' => true]);
    }
}

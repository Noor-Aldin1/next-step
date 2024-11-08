<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Certification;
use Illuminate\Http\Request;

class AdminCertificationController extends Controller
{
    // Store a newly created certification in the database
    public function store(Request $request)
    {
        // Validate incoming request data
        $validated = $request->validate([
            'user_id'    => 'required|exists:users,id',  // Ensure the user exists
            'name'       => 'required|string|max:255',
            'start_due'  => 'required|date',
            'end_due'    => 'required|date|after:start_due',  // Ensure end date is after start date
        ]);

        // Create the certification
        $certification = Certification::create($validated);

        // Return a response, or redirect to another page
        return redirect()->back()->with('success', 'Certification created successfully.');
    }

    // Update the specified certification in the database
    public function update(Request $request, $id)
    {
        // Find the certification by ID
        $certification = Certification::findOrFail($id);

        // Validate incoming request data
        $validated = $request->validate([
            'user_id'    => 'required|exists:users,id',  // Ensure the user exists
            'name'       => 'required|string|max:255',
            'start_due'  => 'required|date',
            'end_due'    => 'required|date|after:start_due',  // Ensure end date is after start date
        ]);

        // Update the certification
        $certification->update($validated);

        // Return a response, or redirect to another page
        return redirect()->back()->with('success', 'Certification updated successfully.');
    }
    public function destroy($id)
    {
        // Find the certification by ID
        $certification = Certification::findOrFail($id);

        // Delete the certification (but do not delete the user)
        $certification->delete();

        // Return a JSON response indicating success
        return response()->json(['success' => true]);
    }
}

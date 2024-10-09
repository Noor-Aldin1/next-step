<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Certification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CertificationController extends Controller
{
    // Display a listing of the user's certifications
    public function index()
    {
        $certifications = Auth::user()->certifications; // Ensure you have the relationship defined in User model
        return view('user.pages.profile.partials.Certifications.index_form_Certifications', 'user.pages.profile.partials.Certifications.Edit_form_Certifications', compact('certifications'));
    }

    // Show the form for creating a new certification
    public function create()
    {
        return view('certifications.create');
    }

    // Store a newly created certification in storage
    public function store(Request $request)
    {
        \Illuminate\Support\Facades\Log::info('Storing certification', $request->all()); // Log incoming request

        $request->validate([
            'name' => 'required|string|max:255',
            'start_due' => 'required|date',
            'end_due' => 'required|date|after_or_equal:start_due',
        ]);

        Certification::create([
            'user_id' => Auth::id(),
            'name' => $request->name,
            'start_due' => $request->start_due,
            'end_due' => $request->end_due,
        ]);

        return redirect()->route('profile.edit')->with('success', 'Certification created successfully.');
    }

    // Show the form for editing the specified certification
    public function edit(Certification $certification)
    {
        return view('certifications.edit', compact('certification'));
    }

    // Update the specified certification in storage
    public function update(Request $request, Certification $certification)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'start_due' => 'required|date',
            'end_due' => 'required|date|after_or_equal:start_due', // Ensure end_due is after or equal to start_due
        ]);

        $certification->update([
            'name' => $request->name,
            'start_due' => $request->start_due,
            'end_due' => $request->end_due,
        ]);

        // Redirect to the index method after updating the certification
        return redirect()->route('profile.edit')->with('success', 'Certification updated successfully.');
    }

    // Remove the specified certification from storage
    public function destroy(Certification $certification)
    {
        // Check if the user owns this certification
        if ($certification->user_id != Auth::id()) {
            return response()->json(['success' => false, 'message' => 'Unauthorized action.'], 403);
        }
    
        // Delete the certification
        $certification->delete();
    
        return response()->json(['success' => true, 'message' => 'Certification deleted successfully.']);
    }
}
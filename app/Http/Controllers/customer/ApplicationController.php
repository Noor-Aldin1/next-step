<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Application;
use App\Models\JobPosting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ApplicationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Fetch all applications for the logged-in user (customer)
        $applications = Application::where('user_id', auth()->id())->get();
        $jobPostings = JobPosting::all();
        // Return a view to list the applications
        return view('user.pages.profile.jobs_appled', compact('applications', 'jobPostings'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Fetch all job postings available for application
        $jobPostings = JobPosting::all();

        // Return the form for creating a new application
        return view('user.pages.application', compact('jobPostings'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the request data
        $validated = $request->validate([
            'job_id' => 'required|exists:job_postings,id',
            'cv' => 'nullable|file|mimes:pdf,doc,docx|max:2048', // CV is now nullable
        ]);

        // Handle file upload for CV
        $cvPath = $request->hasFile('cv') ? $request->file('cv')->store('cvs', 'public') : null;

        // Create and store the application
        Application::create([
            'job_id' => $validated['job_id'],
            'user_id' => auth()->id(),
            'cv' => $cvPath, // Will be null if no CV was uploaded
            'status' => 'pending',
            'applied_at' => now(),
        ]);

        // Redirect to applications index with a success message
        return response()->json([
            'success' => true,
            'message' => 'Application submitted successfully.'
        ]);
    }


    /**
     * Display the specified resource.
     */
    public function show(Application $application)
    {
        // Ensure the application belongs to the logged-in user
        $this->authorize('view', $application);

        // Return the view to show the application details
        return view('applications.show', compact('application'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Application $application)
    {
        // Ensure the application belongs to the logged-in user
        $this->authorize('update', $application);

        // Fetch available job postings
        $jobPostings = JobPosting::all();

        // Return the edit form view
        return view('applications.edit', compact('application', 'jobPostings'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Application $application)
    {
        // Ensure the application belongs to the logged-in user
        $this->authorize('update', $application);

        // Validate the updated data
        $validated = $request->validate([
            'job_id' => 'required|exists:job_postings,id',
            'cv' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
        ]);

        // Handle file upload if a new CV is uploaded
        if ($request->hasFile('cv')) {
            // Delete the old CV if it exists
            if ($application->cv) {
                Storage::disk('public')->delete($application->cv);
            }

            // Store the new CV
            $application->cv = $request->file('cv')->store('cvs', 'public');
        }

        // Update the application
        $application->update([
            'job_id' => $validated['job_id'],
            'cv' => $application->cv,
            'status' => $request->input('status', $application->status),
        ]);

        // Redirect with success message
        return redirect()->route('applications.index')->with('success', 'Application updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Application $application)
    {
        // Ensure the application belongs to the logged-in user
        $this->authorize('delete', $application);

        // Delete the CV file if it exists
        if ($application->cv) {
            Storage::disk('public')->delete($application->cv);
        }

        // Delete the application
        $application->delete();

        // Redirect with success message
        return redirect()->route('applications.index')->with('success', 'Application deleted successfully.');
    }
}

<?php

namespace App\Http\Controllers\Employer;

use App\Models\Application;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ApplicationController extends Controller
{
    /**
     * Display a listing of the applications.
     */
    // use Illuminate\Support\Facades\Auth; // Ensure you have this at the top of your controller

    public function index(Request $request)
    {
        // Get the authenticated employer's ID
        $employerId = Auth::id();

        // Get filtering parameters
        $title = $request->input('title', ''); // Get the title filter

        // Build the base query for applications
        $query = DB::table('applications')
            ->join('job_postings', 'applications.job_id', '=', 'job_postings.id')
            ->join('users', 'applications.user_id', '=', 'users.id')
            ->select('applications.*', 'job_postings.title', 'job_postings.position', 'job_postings.job_type', 'users.username as user_name')
            ->where('job_postings.employer_id', $employerId); // Filter by employer ID

        // Apply filtering by job title if provided
        if (!empty($title)) {
            $query->where('job_postings.title', 'LIKE', '%' . $title . '%');
        }

        // Paginate the results (10 per page)
        $applications = $query->paginate(10);

        // Fetch unique titles for the filter dropdown, only for the employer's job postings
        $titles = DB::table('job_postings')
            ->where('employer_id', $employerId) // Only get titles for the authenticated employer
            ->select('title')
            ->distinct()
            ->pluck('title');

        // Return the filtered applications and titles to the view
        return view('employer.pages.jobaplication', compact('applications', 'titles'));
    }









    public function updateStatus(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:applications,id', // Ensure you check the correct table name
            'status' => 'required|in:Accepted,Rejected',
        ]);

        $application = Application::find($request->id);
        $application->status = $request->status;
        $application->save();

        return response()->json(['message' => 'Status updated successfully!']);
    }
    /**
     * Show the form for creating a new application.
     */
    public function create()
    {
        // You can return a view to create a new application
        return view('employer.applications.create');
    }

    /**
     * Store a newly created application in storage.
     */
    public function store(Request $request)
    {
        // Validate the incoming request
        $validated = $request->validate([
            'job_id' => 'required|exists:job_postings,id',
            'user_id' => 'required|exists:users,id',
            'cv' => 'required|string',
            'status' => 'required|string',
            'applied_at' => 'required|date',
        ]);

        // Create the application
        Application::create($validated);

        // Redirect to the application list with a success message
        return redirect()->route('employer.applications.index')->with('success', 'Application created successfully.');
    }

    /**
     * Display the specified application.
     */
    public function show(string $id)
    {
        // Retrieve a single application with associated job posting and user
        $application = Application::with(['jobPosting', 'user'])->findOrFail($id);
        return view('employer.applications.show', compact('application'));
    }

    /**
     * Show the form for editing the specified application.
     */
    public function edit(string $id)
    {
        // Retrieve the application to edit
        $application = Application::findOrFail($id);
        return view('employer.applications.edit', compact('application'));
    }

    /**
     * Update the specified application in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validate the incoming request
        $validated = $request->validate([
            'job_id' => 'required|exists:job_postings,id',
            'user_id' => 'required|exists:users,id',
            'cv' => 'required|string',
            'status' => 'required|string',
            'applied_at' => 'required|date',
        ]);

        // Find the application and update it
        $application = Application::findOrFail($id);
        $application->update($validated);

        // Redirect to the application list with a success message
        return redirect()->route('employer.applications.index')->with('success', 'Application updated successfully.');
    }

    /**
     * Remove the specified application from storage.
     */
    public function destroy(string $id)
    {
        // Find the application and delete it
        $application = Application::findOrFail($id);
        $application->delete();

        // Redirect to the application list with a success message
        return redirect()->route('employer.applications.index')->with('success', 'Application deleted successfully.');
    }
}

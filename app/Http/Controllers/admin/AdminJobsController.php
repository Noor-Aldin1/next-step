<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JobPosting;
use Illuminate\Http\Request;

class AdminJobsController extends Controller
{
    /**
     * Display a listing of job postings.
     */
    public function index()
    {
        // Fetch all job postings with their associated employer and categories
        $jobPostings = JobPosting::with(['employer', 'categories', 'employerUser'])->paginate(10);




        return view('admin.pages.employer.all_job', compact('jobPostings'));
    }

    /**
     * Show the form for creating a new job posting.
     */
    public function create()
    {
        // Load the view for creating a new job posting
        return view('admin.jobs.create');
    }

    /**
     * Store a newly created job posting in storage.
     */
    public function store(Request $request)
    {
        // Validate incoming request data
        $request->validate([
            'employer_id' => 'required|exists:employers,id',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'requirements' => 'required|string',
            'company_name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'job_type' => 'required|string',
            'experience' => 'required|string',
            'salary' => 'nullable|string',
            'post_due' => 'nullable|date',
            'last_date_to_apply' => 'required|date',
            'city' => 'required|string',
            'address' => 'required|string',
            'education_level' => 'required|string',
        ]);

        // Create a new job posting
        JobPosting::create($request->all());

        return redirect()->route('admin.jobs.index')->with('success', 'Job posting created successfully.');
    }

    /**
     * Display the specified job posting.
     */
    public function show(string $id)
    {
        // Find the job posting by ID and load employer and categories relations
        $jobPosting = JobPosting::with(['employer', 'categories'])->findOrFail($id);

        return view('admin.jobs.show', compact('jobPosting'));
    }

    /**
     * Show the form for editing the specified job posting.
     */
    public function edit(string $id)
    {
        // Find the job posting by ID
        $jobPosting = JobPosting::findOrFail($id);

        return view('admin.jobs.edit', compact('jobPosting'));
    }

    /**
     * Update the specified job posting in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validate the incoming request data
        $request->validate([
            'employer_id' => 'required|exists:employers,id',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'requirements' => 'required|string',
            'company_name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'job_type' => 'required|string',
            'experience' => 'required|string',
            'salary' => 'nullable|string',
            'post_due' => 'nullable|date',
            'last_date_to_apply' => 'required|date',
            'city' => 'required|string',
            'address' => 'required|string',
            'education_level' => 'required|string',
        ]);

        // Find the job posting by ID and update it with new data
        $jobPosting = JobPosting::findOrFail($id);
        $jobPosting->update($request->all());

        return redirect()->route('admin.jobs.index')->with('success', 'Job posting updated successfully.');
    }

    /**
     * Remove the specified job posting from storage.
     */
    public function destroy(string $id)
    {
        // Find the job posting by ID and delete it
        $jobPosting = JobPosting::findOrFail($id);
        $jobPosting->delete();

        return redirect()->route('admin.jobs.index')->with('success', 'Job posting deleted successfully.');
    }
}

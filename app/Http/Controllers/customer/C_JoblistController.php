<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Application;

use App\Models\JobPosting;
use App\Models\JobCategory;
use App\Models\JobPostingCategory;
use Illuminate\Http\Request;
use App\Models\Employer;

use Illuminate\Support\Facades\DB;

class C_JoblistController extends Controller
{
    /**
     * Display a listing of the job postings.
     */
    public function index()
    {


        $jobs = JobPosting::with('categories') // Eager load categories for optimization
            ->paginate(10); // Pagination to limit jobs to 10 per page

        $categories_name = DB::table('job_posting_categories')
            ->join('job_postings', 'job_postings.id', '=', 'job_posting_categories.job_id')
            ->join('job_categories', 'job_posting_categories.category_id', '=', 'job_categories.id')
            ->select('job_categories.name', 'job_postings.id')
            ->get();


        return view('user.pages.joblist',  compact('categories_name',  'jobs')); // Pass the jobs variable to the view
    }

    /**
     * Show the form for creating a new job posting.
     */
    public function create()
    {
        $categories = JobCategory::all();
        return view('user.pages.create_job', compact('categories')); // Updated the view path
    }

    /**
     * Store a newly created job posting in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'employer_id' => 'required|exists:employers,id',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'requirements' => 'nullable|string',
            'company_name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'job_type' => 'required|string',
            'experience' => 'nullable|string',
            'salary' => 'nullable|numeric',
            'post_due' => 'required|date',
            'last_date_to_apply' => 'required|date',
            'city' => 'required|string|max:255',
            'education_level' => 'nullable|string',
            'categories' => 'array|exists:job_categories,id',
        ]);

        $jobPosting = JobPosting::create($request->except('categories'));

        if ($request->has('categories')) {
            $jobPosting->categories()->sync($request->categories);
        }

        return redirect()->route('job_postings.index')->with('success', 'Job posting created successfully.');
    }

    /**
     * Display the specified job posting.
     */
    public function show(string $id)
    {
        // Fetching categories related to the specific job posting
        $categories_name = DB::table('job_posting_categories')
            ->join('job_postings', 'job_postings.id', '=', 'job_posting_categories.job_id')
            ->join('job_categories', 'job_posting_categories.category_id', '=', 'job_categories.id')
            ->select('job_categories.name', 'job_postings.id')
            ->where('job_postings.id', '=', $id)
            ->get();
        $employer_tab = Employer::all();

        // return user name 
        $employer_name = DB::table('employers')
            ->join('users', 'users.id', '=', 'employers.user_id')
            ->join('job_postings', 'employers.id', '=', 'job_postings.employer_id')
            ->select('users.username', 'employers.account_manager')
            ->distinct()
            ->where('job_postings.id', $id)
            ->get();
        // dd($employer_name);

        // Fetch the job posting along with its employer and categories
        $jobPosting = JobPosting::with(['employer', 'categories'])->findOrFail($id);

        $applications = Application::where('user_id', auth()->id())->get();
        // /        $jobPostings_a = JobPosting::findOrFail($id);


        // Pass both the job posting and categories to the view
        return view('user.pages.Job_description', compact('jobPosting', 'categories_name', 'employer_name', 'applications'));
    }

    /**
     * Show the form for editing the specified job posting.
     */
    public function edit(string $id)
    {
        $jobPosting = JobPosting::with('categories')->findOrFail($id);
        $categories = JobCategory::all();
        return view('user.pages.edit_job', compact('jobPosting', 'categories')); // Updated the view path
    }

    /**
     * Update the specified job posting in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'employer_id' => 'required|exists:employers,id',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'requirements' => 'nullable|string',
            'company_name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'job_type' => 'required|string',
            'experience' => 'nullable|string',
            'salary' => 'nullable|numeric',
            'post_due' => 'required|date',
            'last_date_to_apply' => 'required|date',
            'city' => 'required|string|max:255',
            'education_level' => 'nullable|string',
            'categories' => 'array|exists:job_categories,id',
        ]);

        $jobPosting = JobPosting::findOrFail($id);
        $jobPosting->update($request->except('categories'));

        if ($request->has('categories')) {
            $jobPosting->categories()->sync($request->categories);
        }

        return redirect()->route('job_postings.index')->with('success', 'Job posting updated successfully.');
    }

    /**
     * Remove the specified job posting from storage.
     */
    public function destroy(string $id)
    {
        $jobPosting = JobPosting::findOrFail($id);
        $jobPosting->delete();
        return redirect()->route('job_postings.index')->with('success', 'Job posting deleted successfully.');
    }


    public function job10()
    {
        // Fetch jobs with their categories
        $jobs = JobPosting::with('categories') // Eager load categories for optimization
            ->paginate(3); // Pagination to limit jobs to 10 per page

        // We no longer need to separately query for categories since they are eager-loaded with 'categories'

        return view('user.partials.job_list_10', compact('jobs')); // Pass only 'jobs' to the view
    }
}
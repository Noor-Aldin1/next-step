<?php

namespace App\Http\Controllers\Employer;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\Controller;
use App\Models\JobPosting;
use App\Models\JobCategory;
use App\Models\Employer;
use App\Models\JobPostingCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; // Add this line
class job_postingController extends Controller
{
    protected $categories_name;
    protected  $jobPostings;
    /**preavite
     * Display a listing of the resource.
     */

    // Constructor to fetch all job categories before loading the index page
    public function __construct()
    {
        $employer = Employer::where('user_id', auth()->id())->first(); // Get the first employer found


        // This is called automatically when the controller is used
        $this->categories_name = JobCategory::all(); // Get all job categories

        // Check if the employer exists before trying to get job postings
        if ($employer) {
            $this->jobPostings = JobPosting::where('employer_id', $employer->id)->get();
        } else {
            $this->jobPostings = collect(); // Initialize as an empty collection if no employer found
        }
    }
    public function index()
    {

        $employerId = Auth::id(); // Assuming that the employer is authenticated

        // Get all job postings for the employer
        $jobPostings = JobPosting::where('employer_id', auth()->id())->get();

        return view('employer.pages.dashbooard', compact('jobPostings'));
    }

    public function joblist()
    {
        // Get paginated job postings for the employer
        $jobs = JobPosting::where('employer_id', auth()->id())->paginate(10); // Adjust the number of items per page as needed

        return view('employer.pages.joblist', compact('jobs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $employer = Employer::where('user_id', auth()->id())->first(); // Get the first employer found


        $this->jobPostings = JobPosting::where('employer_id', $employer->id)->get();
        $jobPostings = $this->jobPostings;

        $categories_name = $this->categories_name;


        return view('employer.pages.dashbooard', ['categories_name' => $categories_name, 'jobPostings' => $jobPostings]);
    }

    /**
     * Store a newly created resource in storage.
     */

    function gitcategory()
    {
        $item = [];

        foreach ($this->categories_name as $category) {
            // Assuming you want to push the name of the category to the array
            array_push($item, $category->name); // Change this to the appropriate property you want to collect
        }

        // Create a comma-separated string from the collected names
        $stringName = implode(",", $item);

        return $stringName; // Return the final string
    }
    public function store(Request $request)
    {
        try {
            // Validation for form inputs
            $validatedData = $request->validate([
                'title' => 'required|max:255',
                'description' => 'nullable',
                'requirements' => 'nullable',
                'company_name' => 'required|max:255',
                'position' => 'required|max:255',
                'job_type' => 'required|in:Full-time,Part-time,Contract,Internship',
                'experience' => 'nullable|max:255',
                'salary' => 'nullable|numeric',
                'post_due' => 'nullable|date',
                'last_date_to_apply' => 'nullable|date',
                'city' => 'required|in:Amman,Irbid,Balqa,Karak,Ma\'an,Mafraq,Tafilah,Zarqa,Madaba,Jerash,Ajloun,Aqaba',
                'address' => 'required|max:255',
                'education_level' => 'nullable|max:255',
                'category' => 'required|in:' .  $this->gitcategory(), // Adjusted for valid category check
            ]);

            // Create the job posting
            $jobPosting = JobPosting::create([
                'employer_id' => auth()->id(),
                'title' => $validatedData['title'],
                'description' => $validatedData['description'],
                'requirements' => $validatedData['requirements'],
                'company_name' => $validatedData['company_name'],
                'position' => $validatedData['position'],
                'job_type' => $validatedData['job_type'],
                'experience' => $validatedData['experience'],
                'salary' => $validatedData['salary'],
                'post_due' => now(), // Set post_due to today's date
                'last_date_to_apply' => $validatedData['last_date_to_apply'],
                'city' => $validatedData['city'],
                'address' => $validatedData['address'],
                'education_level' => $validatedData['education_level'],
            ]);

            // Retrieve the category name from validated data
            $categoryName = $validatedData['category'];

            // Retrieve all categories only once to avoid repeated database calls
            $category = JobCategory::where('name', $categoryName)->first();
            $matchingId = $category ? $category->id : null;

            // Create the JobPostingCategory relationship
            JobPostingCategory::create([
                'job_id' => $jobPosting->id, // Use the recently created job posting's ID
                'category_id' => $matchingId, // Use the matching category ID or null if not found
            ]);

            // Return success response
            return redirect()->route('employer.panel')->with('success', 'Job posting created successfully.');
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Handle validation errors
            return redirect()->back()->withErrors($e->validator)->withInput();
        } catch (\Exception $e) {
            // Log the error for debugging
            Log::error('Error creating job posting: ' . $e->getMessage());

            // Return error response
            return redirect()->back()->with('error', 'An error occurred while creating the job posting. Please try again later.');
        }
    }



    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $jobPosting = JobPosting::findOrFail($id);
        $categories_name = DB::table('job_posting_categories')
            ->join('job_postings', 'job_posting_categories.job_id', '=', 'job_postings.id')
            ->join('job_categories', 'job_posting_categories.category_id', '=', 'job_categories.id')
            ->where('job_posting_categories.job_id', $id) // Ensure you're filtering by the correct job ID
            ->select('job_categories.name') // Select only the category name
            ->get();
        // Use get() to retrieve all categories related to the job posting

        return view('employer.pages.job_view', compact('jobPosting', 'categories_name'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {

        $jobPosting = JobPosting::findOrFail($id);

        return view('employer.job_postings.edit', compact('jobPosting'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Begin a try-catch block to handle any exceptions
        try {
            // Validate the update request
            $validatedData = $request->validate([
                'title' => 'required|max:255',
                'description' => 'nullable|string',
                'requirements' => 'nullable|string',
                'company_name' => 'required|max:255',
                'position' => 'required|max:255',
                'job_type' => 'required|in:Full-time,Part-time,Contract,Internship',
                'experience' => 'nullable|max:255',
                'salary' => 'nullable|numeric',
                'post_due' => 'nullable|date',
                'last_date_to_apply' => 'nullable|date',
                'city' => 'required|in:Amman,Irbid,Balqa,Karak,Ma\'an,Mafraq,Tafilah,Zarqa,Madaba,Jerash,Ajloun,Aqaba',
                'address' => 'required|max:255',
                'education_level' => 'nullable|max:255',
                'category' => 'required|in:' . $this->gitcategory(), // Assuming this method returns a string of valid categories
            ]);

            // Find the job posting to be updated
            $jobPosting = JobPosting::findOrFail($id); // Will throw a 404 if not found

            // Update the job posting with validated data
            $jobPosting->update($validatedData);

            // Handle the job category relationship
            $categoryName = $validatedData['category'];
            $category = JobCategory::where('name', $categoryName)->first();
            $matchingId = $category ? $category->id : null;

            // Update or create the JobPostingCategory relationship
            JobPostingCategory::updateOrCreate(
                ['job_id' => $jobPosting->id], // Find by job_id
                ['category_id' => $matchingId] // Update the category_id
            );

            // Redirect back with success message
            return redirect()->route('employer.job_postings.index')->with('success', 'Job posting updated successfully.');
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Handle validation errors and redirect back with error messages
            return redirect()->back()->withErrors($e->validator)->withInput();
        } catch (\Exception $e) {
            // Log the error for debugging
            Log::error('Error updating job posting: ' . $e->getMessage());

            // Return error response
            return redirect()->back()->with('error', 'An error occurred while updating the job posting. Please try again later.');
        }
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            // Attempt to find the job posting by ID
            $jobPosting = JobPosting::findOrFail($id);

            // Delete the job posting
            $jobPosting->delete();

            // Return a success response as JSON
            return response()->json([
                'success' => true,
                'message' => 'Job posting deleted successfully.'
            ]);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            // Handle the case where the job posting is not found
            Log::error('Job posting not found: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Job posting not found.'
            ], 404);
        } catch (\Exception $e) {
            // Log any other exceptions that occur
            Log::error('Error deleting job posting: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while deleting the job posting. Please try again later.'
            ], 500);
        }
    }
}

<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\JobPosting;
use App\Models\JobCategory;
use Illuminate\Http\Request;

class filter_job extends Controller
{
    /**
     * Handle job filtering logic.
     */
    private function getFilteredJobs(Request $request)
    {
        // Fetch all job categories
        $job_categories = JobCategory::all();

        // List of all possible cities
        $allCities = [
            'Amman',
            'Irbid',
            'Balqa',
            'Karak',
            'Ma\'an', // Corrected spelling with an apostrophe
            'Mafraq',
            'Tafilah',
            'Zarqa',
            'Madaba',
            'Jerash',
            'Ajloun',
            'Aqaba'
        ];

        // Fetch existing cities from job postings in the database
        $existingCities = JobPosting::select('city')->distinct()->pluck('city')->toArray();

        // Merge and deduplicate cities
        $cities = array_unique(array_merge($allCities, $existingCities));

        // Get filter inputs from the request
        $job_filter_search = $request->input('search');
        $category_filter = $request->input('category');
        $city_filter = $request->input('city');

        // Apply filters to job postings
        $job_list = JobPosting::query()
            // Filter by title, company name, or job type
            ->when($job_filter_search, function ($query, $job_filter_search) {
                return $query->where(function ($q) use ($job_filter_search) {
                    $q->where('title', 'like', '%' . $job_filter_search . '%')
                        ->orWhere('company_name', 'like', '%' . $job_filter_search . '%')
                        ->orWhere('job_type', 'like', '%' . $job_filter_search . '%');
                });
            })
            // Filter by category
            ->when($category_filter, function ($query, $category_filter) {
                return $query->whereHas('categories', function ($q) use ($category_filter) {
                    $q->where('job_categories.id', $category_filter);
                });
            })
            // Filter by city
            ->when($city_filter, function ($query, $city_filter) {
                return $query->where('city', $city_filter);
            })
            ->paginate(10); // Pagination, 10 jobs per page

        // Check if there are no jobs found
        $noJobsFound = $job_list->isEmpty();

        // Return the necessary data for the views
        return [
            'job_categories' => $job_categories,
            'jobs' => $job_list,
            'cities' => $cities,
            'noJobsFound' => $noJobsFound,
        ];
    }

    /**
     * Display job postings with filters on the Job Listings page.
     */
    public function felter(Request $request)
    {
        // Get filtered jobs data
        $data = $this->getFilteredJobs($request);

        // Return the job list view with the data
        return view('user.pages.joblist')
            ->with('job_categories', $data['job_categories'])
            ->with('jobs', $data['jobs'])
            ->with('cities', $data['cities'])
            ->with('noJobsFound', $data['noJobsFound']);
    }

    /**
     * Display job postings with filters on the Home page.
     */
    public function homePage(Request $request)
    {
        // Get filtered jobs data (reusing the filter logic)
        $data = $this->getFilteredJobs($request);

        // Return the home page view with the data (assuming a different view for home page)
        return view('user.pages.home')
            ->with('job_categories', $data['job_categories'])
            ->with('jobs', $data['jobs'])
            ->with('cities', $data['cities'])
            ->with('noJobsFound', $data['noJobsFound']);
    }
}
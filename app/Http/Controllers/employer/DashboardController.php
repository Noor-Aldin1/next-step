<?php

namespace App\Http\Controllers\Employer;

use App\Http\Controllers\Controller;
use App\Models\Application;

use Illuminate\Http\Request;
use App\Http\Controllers\Employer\job_postingController;


class DashboardController extends Controller
{
    protected $jobController;

    public function __construct(job_postingController $jobController)
    {
        $this->jobController = $jobController;
    }


    public function index()
    {
        $this->jobController->create();
        $jobPostings = session('jobPostings');
        $categories_name = session('categories_name');



        return view('employer.pages.dashbooard', compact('jobPostings', 'categories_name'));
    }
}

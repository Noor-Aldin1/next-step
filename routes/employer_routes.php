<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Employer\job_postingController;
use App\Http\Controllers\Auth\RegisterdEmployerController;
use Illuminate\Support\Facades\Auth;
use App\Models\Employer;
use App\Models\JobPosting;
use App\Models\Application;

use App\Http\Controllers\Employer\ApplicationController;

// Group routes that require authentication
Route::middleware(['auth'])->group(function () {
    // Display a listing of the job postings (GET)
    Route::get('employer/job_postings', [job_postingController::class, 'index'])->name('employer.job_postings.index');

    // Show the form for creating a new job posting (GET)
    Route::get('employer/job_postings/create', [job_postingController::class, 'create'])->name('employer.job_postings.create');

    // Store a newly created job posting (POST)
    Route::post('employer/job_postings', [job_postingController::class, 'store'])->name('employer.job_postings.store');

    // Display the specified job posting (GET)
    Route::get('employer/job_postings/{id}', [job_postingController::class, 'show'])->name('employer.job_postings.show');

    // Show the form for editing the specified job posting (GET)
    Route::get('employer/job_postings/{id}/edit', [job_postingController::class, 'edit'])->name('employer.job_postings.edit');

    // Update the specified job posting (PUT/PATCH)
    Route::put('employer/job_postingss/{id}', [job_postingController::class, 'update'])->name('employer.job_postings.update');

    // Remove the specified job posting (DELETE)
    Route::delete('employer/job_postings/{id}', [job_postingController::class, 'destroy'])->name('employer.job_postings.destroy');
    Route::get('/employer/profile', [RegisterdEmployerController::class, 'edit'])->name('employer.profile.edit');
});
Route::put('/employer/profile/{id}', [RegisterdEmployerController::class, 'update'])->name('employer.profile.update');

// ---------------------------------------
// Index home for employer


// joblist controller

Route::get('employer/job_postings/joblist/ee', [job_postingController::class, 'joblist'])->name('employer.job_postings.index');



// job Aplication 


Route::get('/employer/Application', [ApplicationController::class, 'index'])->name('index'); // List all applications
Route::post('/applications/update-status', [ApplicationController::class, 'updateStatus'])->name('applications.updateStatus');






Route::get('/employer/profile/delete2', function () {
    return view('employer.pages.dashbooard');
})->name('employer.panel');
Route::get('/employer/profile/delete', function () {
    // Get the currently authenticated user
    $user = Auth::user();

    // Find the employer associated with the user
    $employer = Employer::where('user_id', $user->id)->first();

    // Count the number of jobs posted by the employer
    $jobCount = JobPosting::where('employer_id', $employer->id)->count();

    // Count the total number of applicants for the jobs posted by this employer
    $totalApplicants = Application::whereIn('id', function ($query) use ($employer) {
        $query->select('id')
            ->from('job_postings')
            ->where('employer_id', $employer->id);
    })->count();

    // Return the view with the user, employer, job count, and applicant count
    return view('employer.pages.profile.change_pass', [
        'user' => $user,
        'employer' => $employer,
        'jobCount' => $jobCount,
        'totalApplicants' => $totalApplicants,
    ]);
})->name('employer.profile.delete');

// Display the specified job posting from Employer (GET)
Route::get('/business_owner/register', function () {
    // Get data from JobPostingController
    $jobPostings = app(job_postingController::class)->index();

    // Pass the data to the view
    return view('employer.pages.dashbooard', compact('jobPostings'));
});
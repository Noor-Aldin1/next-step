<?php

use App\Http\Controllers\Customer\C_ProfileController;
use App\Http\Controllers\Customer\C_JoblistController;
use App\Http\Controllers\Customer\Filter_job;
use App\Http\Controllers\Customer\CertificationController;
use App\Http\Controllers\Customer\ExperienceController;
use App\Http\Controllers\Customer\SkillController;
use App\Http\Controllers\Customer\ApplicationController;
use App\Http\Controllers\Customer\ResumeController;
use App\Http\Controllers\Customer\ProjectController;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Customer\PackageController;
// -------------routes for navbar -------------
Route::get('/student/about', function () {
    return view('user.pages.about');
})->name('about');
Route::get('/student/soft', function () {
    return view('user.pages.soft-skills');
})->name('soft');
Route::get('/student/contact', function () {
    return view('user.pages.contact-us');
})->name('contact');
Route::get('/student/FAQ', function () {

    return view('user.pages.fqs');
})->name('FAQ');
Route::get('/student/Privacy', function () {

    return view('user.pages.Privacy');
})->name('Privacy');

Route::get('/student/Terms', function () {

    return view('user.pages.Terms');
})->name('Terms');
Route::get('/student/Packages', function () {

    return view('user.pages.Packages');
})->name('Packages');
Route::get('/student/Change', function () {

    return view('user.pages.profile.changepass');
})->name('change.password');

// -------------routes for profile/register -------------
Route::middleware(['auth'])->group(function () {
    Route::get('/profile/edit/Customer', [C_ProfileController::class, 'edit'])->name('profile.edit');
    // Route::post('/profile/edit/createProjects', [C_ProfileController::class, 'createProjects'])->name('profile.createProjects');
    Route::post('/profile/edit/Customer', [C_ProfileController::class, 'updateProjects'])->name('profile.updateProjects');
    Route::post('/profile/edit/skill', [C_ProfileController::class, 'updateSkills'])->name('profile.updateSkills');
    Route::post('/profile/update/Customer', [C_ProfileController::class, 'update'])->name('profile.update');
    Route::resource('certifications', CertificationController::class);
    Route::resource('projects', ProjectController::class);
    Route::resource('experiences', ExperienceController::class);
    Route::resource('skills', SkillController::class)->except(['show']);
    Route::put('/skills/{id}', [SkillController::class, 'update'])->name('skills.update');

    Route::get('/skills/create', [SkillController::class, 'create'])->name('skills.create');
    Route::post('/skills/store', [SkillController::class, 'store'])->name('skills.store');


    Route::delete('/UserSkill/{userSkill}', [SkillController::class, 'destroy'])->name('skills.destroy');


    Route::resource('job_postings/applications', ApplicationController::class);

    Route::resource('resumes', ResumeController::class);

    Route::post('/profile/upload-image', [C_ProfileController::class, 'uploadImage'])->name('profile.uploadImage');


    //checout 
    Route::resource('packages', PackageController::class);
});



// pdf CV 
Route::get('resumes/{id}/download', [ResumeController::class, 'downloadPdf'])->name('resumes.download');


// joblist route
Route::resource('job_postings', C_JoblistController::class);
Route::get('/jobs/job10', [C_JoblistController::class, 'job10'])->name('job_postings.job10');




// filter jobs

// Job listings page route
Route::get('/jobs', [filter_job::class, 'felter'])->name('jobs.felter');

// Home page route
Route::get('/', [filter_job::class, 'homePage'])->name('home');



// checkout 

Route::get('/student/checkout', function () {
    return view('user.pages.checkout');
})->name('checkout');

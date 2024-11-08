<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\AdminDashController;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;
use App\Http\Controllers\admin\AdminEmployerController;
use App\Http\Controllers\Admin\AdminJobsController;
use App\Http\Controllers\Admin\AdminUserController;

use App\Http\Controllers\admin\AdminCertificationController;
use App\Http\Controllers\Admin\AdminSkillController;
use App\Http\Controllers\admin\AdminExperienceController;
use App\Http\Controllers\admin\AdminProjectsController;



// ---------Dashboard
Route::get('/admin/dashboard', [AdminDashController::class, 'dash'])->name('admin.dashboard');





// ----------Employers --------------
Route::prefix('admin')->group(function () {
    // Route for displaying all employers
    Route::get('/employers', [AdminEmployerController::class, 'index'])->name('admin.employers.index');

    // Route for showing the form to create a new employer
    Route::get('employers/create', [AdminEmployerController::class, 'create'])->name('admin.employers.create');

    // Route for storing a newly created employer
    Route::post('employers', [AdminEmployerController::class, 'store'])->name('admin.employers.store');

    // Route for displaying a specific employer
    Route::get('employers/{id}', [AdminEmployerController::class, 'show'])->name('admin.employers.show');

    // Route for showing the form to edit a specific employer
    Route::get('employers/{id}/edit', [AdminEmployerController::class, 'edit'])->name('admin.employers.edit');

    // Route for updating a specific employer
    Route::put('employers/{id}', [AdminEmployerController::class, 'update'])->name('admin.employers.update');

    // Route for deleting a specific employer
    Route::delete('employers/{id}', [AdminEmployerController::class, 'destroy'])->name('admin.employers.destroy');
});









// Admin Job Postings Routes
Route::prefix('admin/jobs')->name('admin.jobs.')->group(function () {
    Route::get('/', [AdminJobsController::class, 'index'])->name('index'); // Display all job postings
    Route::get('/create', [AdminJobsController::class, 'create'])->name('create'); // Show create form
    Route::post('/', [AdminJobsController::class, 'store'])->name('store'); // Store a new job posting
    Route::get('/{id}', [AdminJobsController::class, 'show'])->name('show'); // Show a specific job posting
    Route::get('/{id}/edit', [AdminJobsController::class, 'edit'])->name('edit'); // Show edit form
    Route::put('/{id}', [AdminJobsController::class, 'update'])->name('update'); // Update a job posting
    Route::delete('/{id}', [AdminJobsController::class, 'destroy'])->name('destroy'); // Delete a job posting
});




// ---------------------Admin Users -------------


Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('users', [AdminUserController::class, 'index'])->name('users.index'); // List all users
    Route::get('users/create', [AdminUserController::class, 'create'])->name('users.create'); // Show create form
    Route::post('users', [AdminUserController::class, 'store'])->name('users.store'); // Store new user
    Route::get('users/{id}', [AdminUserController::class, 'show'])->name('users.show'); // Display specific user
    Route::get('users/profileEdit/{id}', [AdminUserController::class, 'profileEdit'])->name('profileEdit.show'); // Display specific user
    Route::put('users/profileUpdate/{id}', [AdminUserController::class, 'profileUpdate'])->name('users.profileUpdate'); // Display specific user
    Route::get('users/{id}/edit', [AdminUserController::class, 'edit'])->name('users.edit'); // Show edit form
    Route::put('users/{id}', [AdminUserController::class, 'update'])->name('users.update'); // Update user
    Route::delete('users/{id}', [AdminUserController::class, 'destroy'])->name('users.destroy'); // Delete user
    // -------skill -----------
    Route::POST('skills', [AdminSkillController::class, 'store'])->name('user.skills.store');
    Route::put('/user/skills/{id}', [AdminSkillController::class, 'update'])->name('user.skills.update');
    // Route::delete('/user/skills/{id}', [AdminSkillController::class, 'destroy'])->name('user.skills.destroy');
});
Route::delete('/user/skills/{id}', [AdminSkillController::class, 'destroy'])->name('admin.user.skills.destroy');



// Admin Certification Routes
Route::prefix('admin')->name('admin.')->group(function () {
    // Route to store a new certification
    Route::post('/certifications/store', [AdminCertificationController::class, 'store'])->name('certifications.store');

    // Route to update an existing certification
    Route::put('/certifications/{id}', [AdminCertificationController::class, 'update'])->name('certifications.update');
    Route::delete('/certifications/{id}', [AdminCertificationController::class, 'destroy'])->name('certifications.destroy');
});


// AdminExperienceController;

Route::prefix('admin')->name('admin.')->group(function () {
    Route::post('/experiences', [AdminExperienceController::class, 'store'])->name('experiences.store');
    Route::put('/experiences/{id}', [AdminExperienceController::class, 'update'])->name('experiences.update');
    Route::delete('/experiences/{id}', [AdminExperienceController::class, 'destroy'])->name('experiences.destroy');
});



//projectsController 
Route::post('/admin/projects', [AdminProjectsController::class, 'store'])->name('admin.projects.store');
Route::put('/admin/projects/{id}', [AdminProjectsController::class, 'update'])->name('admin.projects.update');
Route::delete('/admin/projects/{id}', [AdminProjectsController::class, 'destroy'])->name('admin.projects.destroy');

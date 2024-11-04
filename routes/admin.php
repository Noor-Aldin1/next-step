<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\AdminDashController;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;
use App\Http\Controllers\admin\AdminEmployerController;
use App\Http\Controllers\Admin\AdminJobsController;

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

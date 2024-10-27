<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Mentor\DashboardController;
use App\Http\Controllers\mentor\AllStudentController;
use App\Http\Controllers\mentor\CoursesController;
use App\Http\Controllers\mentor\EventManagementController;









// Define routes for the mentor dashboard
Route::middleware(['auth', 'role:2'])->prefix('mentor')->group(function () {});
Route::get('/overview', [DashboardController::class, 'index'])->name('mentor.dashboard');
Route::get('dashboard/create', [DashboardController::class, 'create'])->name('mentor.dashboard.create');
Route::post('dashboard/store', [DashboardController::class, 'store'])->name('mentor.dashboard.store');
Route::get('dashboard/{id}', [DashboardController::class, 'show'])->name('mentor.dashboard.show');
Route::get('dashboard/{id}/edit', [DashboardController::class, 'edit'])->name('mentor.dashboard.edit');
Route::put('dashboard/{id}', [DashboardController::class, 'update'])->name('mentor.dashboard.update');
Route::delete('dashboard/{id}', [DashboardController::class, 'destroy'])->name('mentor.dashboard.destroy');


// allstudent 
Route::get('/mentor/students', [AllStudentController::class, 'index'])->name('mentor.students.index');
Route::get('/mentor/students/{id}', [AllStudentController::class, 'show'])->name('mentor.students.show');

Route::middleware(['auth'])->group(function () {
    Route::resource('/mentor/courses', CoursesController::class);
});




Route::group(['prefix' => 'mentor/courses', 'as' => 'courses.student.'], function () {
    Route::get('/all', [CoursesController::class, 'index'])->name('index'); // List all courses
    Route::get('/create', [CoursesController::class, 'create'])->name('create'); // Show create course form
    Route::post('/', [CoursesController::class, 'store'])->name('store'); // Store new course
    Route::get('/{id}', [CoursesController::class, 'show'])->name('show'); // Show specific course
    Route::get('/{id}/edit', [CoursesController::class, 'edit'])->name('edit'); // Show edit course form
    Route::put('/{id}', [CoursesController::class, 'update'])->name('update'); // Update course
    Route::delete('/{id}', [CoursesController::class, 'destroy'])->name('destroy'); // Delete course
    Route::get('/courses/{id}', [CoursesController::class, 'show'])->name('show');
    Route::match(['get', 'post'], '/courses/{courseId}/schedule', [CoursesController::class, 'scheduleLecture'])->name('schedule');
});





// --------Event handlers------
Route::middleware(['auth'])->group(function () {
    Route::get('/mentor/events', [EventManagementController::class, 'index'])->name('mentor.events.index'); // List all events
    Route::get('/mentor/events/create', [EventManagementController::class, 'create'])->name('mentor.events.create'); // Show form to create a new event
    Route::post('/mentor/events', [EventManagementController::class, 'store'])->name('mentor.events.store'); // Store a new event
    Route::get('/mentor/events/{id}', [EventManagementController::class, 'show'])->name('mentor.events.show'); // Display a specific event
    Route::get('/mentor/events/{id}/edit', [EventManagementController::class, 'edit'])->name('mentor.events.edit'); // Show form to edit an event
    Route::put('/mentor/events/{id}', [EventManagementController::class, 'update'])->name('mentor.events.update'); // Update an event
    Route::delete('/mentor/events/{id}', [EventManagementController::class, 'destroy'])->name('mentor.events.destroy'); // Delete an event
});

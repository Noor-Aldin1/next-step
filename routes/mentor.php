<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Mentor\DashboardController;
use App\Http\Controllers\mentor\AllStudentController;
use App\Http\Controllers\mentor\CoursesController;
use App\Http\Controllers\mentor\EventManagementController;
use App\Http\Controllers\mentor\TasksController;
use App\Http\Controllers\Mentor\MaterialController;









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
    Route::get('/{id}', [CoursesController::class, 'show'])->name('show1'); // Show specific course
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
    Route::post('/mentor/addMeeting', [EventManagementController::class, 'store'])->name('mentor.events.store'); // Store a new event
    Route::post('/mentor/events', [EventManagementController::class, 'addMeeting'])->name('meetings.add'); // Store a new event
    Route::post('/mentor/addLecture', [EventManagementController::class, 'addLecture'])->name('addLecture.add'); // Store a new event

    Route::get('/mentor/events/{id}', [EventManagementController::class, 'show'])->name('mentor.events.show'); // Display a specific event
    Route::get('/mentor/events/{id}/edit', [EventManagementController::class, 'edit'])->name('mentor.events.edit'); // Show form to edit an event
    Route::put('/mentor/events/{id}', [EventManagementController::class, 'update'])->name('mentor.events.update'); // Update an event
    Route::delete('/mentor/events/{id}', [EventManagementController::class, 'destroy'])->name('mentor.events.destroy'); // Delete an event
});


// --------Task handlers------ 

Route::get('mentor/courses/{id}/tasks', [TasksController::class, 'index'])->name('mentor.tasks.index');

// // Route for showing a specific task
Route::get('mentor/tasks/{id}', [TasksController::class, 'show'])->name('mentor.tasks.show');

// Route for creating a new task
Route::get('mentor/tasks/create', [TasksController::class, 'create'])->name('mentor.tasks.create');

// Route for storing a new task
Route::post('mentor/tasks', [TasksController::class, 'store'])->name('mentor.tasks.store');

// Route for editing a specific task
Route::get('mentor/tasks/{id}/edit', [TasksController::class, 'edit'])->name('mentor.tasks.edit');

Route::get('mentor/tasks/{id}/AnswerTask', [TasksController::class, 'AnswerTask'])->name('mentor.AnswerTask');

// Route for updating a specific task
Route::put('mentor/tasks/{id}', [TasksController::class, 'update'])->name('mentor.tasks.update');

// Route for deleting a specific task
Route::delete('mentor/tasks/{id}', [TasksController::class, 'destroy'])->name('mentor.tasks.destroy');





// Mentor materials routes
Route::prefix('mentor/materials')->name('mentor.materials.')->middleware('auth')->group(function () {
    // Display a list of materials for a specific course
    Route::get('/course/{id}', [MaterialController::class, 'index'])->name('course'); // Unique name for course-specific materials

    // List all materials
    Route::get('/', [MaterialController::class, 'all'])->name('index');

    // Other material management routes
    Route::get('/create', [MaterialController::class, 'create'])->name('create'); // Create material form
    Route::post('/', [MaterialController::class, 'store'])->name('store'); // Store new material
    Route::get('/{id}', [MaterialController::class, 'show'])->name('show'); // Show specific material
    Route::get('/{id}/edit', [MaterialController::class, 'edit'])->name('edit'); // Edit specific material
    Route::put('/{id}', [MaterialController::class, 'update'])->name('update'); // Update specific material
    Route::delete('/{id}', [MaterialController::class, 'destroy'])->name('destroy'); // Delete specific material
});

<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TranslateController;
use App\Http\Controllers\MentorController;
use App\Http\Controllers\EmailController;

// ---------------Another Routes-------
require base_path('routes/custom_routes.php');
require base_path('routes/auth.php');
require base_path('routes/employer_routes.php');

require __DIR__ . '/auth.php';
require __DIR__ . '/mentor.php';
require __DIR__ . '/admin.php';


//business_owner
Route::get('/business_owner', function () {
    return view('user.pages.business_owner');
})->name('business_owner');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    // Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    // Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});




// Mentor Routes
Route::middleware(['auth'])->group(function () {
    Route::get('/profile/mentors', [MentorController::class, 'index'])->name('mentorsuser.index'); // List all mentors
    Route::get('/profile/mentors/create', [MentorController::class, 'create'])->name('mentorsuser.create'); // Show form to create a new mentor
    Route::post('/profile/mentors', [MentorController::class, 'store'])->name('mentorsuser.store'); // Store a new mentor
    Route::get('/profile/mentors/{id}', [MentorController::class, 'show'])->name('mentorsuser.show'); // Show specific mentor details
    Route::get('/profile/mentors/{id}/edit', [MentorController::class, 'edit'])->name('mentorsuser.edit'); // Show form to edit a mentor
    Route::put('/profile/mentors/{id}', [MentorController::class, 'update'])->name('mentorsuser.update'); // Update a specific mentor
    Route::delete('/profile/mentors/{id}', [MentorController::class, 'destroy'])->name('mentorsuser.destroy'); // Delete a specific mentor
});




// for  email

Route::post('/send-offer-email', [EmailController::class, 'sendOffer'])->name('send.offer.email');


// test 
Route::get('/alls/test', function () {
    return view('admin.pages.mentors.courses.course_ditails');
});

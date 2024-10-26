<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TranslateController;

// ---------------Another Routes-------
require base_path('routes/custom_routes.php');
require base_path('routes/auth.php');
require base_path('routes/employer_routes.php');

require __DIR__ . '/auth.php';
require __DIR__ . '/mentor.php';


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



// test 
Route::get('/alls/test', function () {
    return view('mentor.pages.event_management');
});

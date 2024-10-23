<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Mentor\DashboardController;








// Define routes for the mentor dashboard
Route::middleware(['auth', 'role:2'])->prefix('mentor')->group(function () {
});
Route::get('/overview', [DashboardController::class, 'index'])->name('mentor.dashboard');
Route::get('dashboard/create', [DashboardController::class, 'create'])->name('mentor.dashboard.create');
Route::post('dashboard/store', [DashboardController::class, 'store'])->name('mentor.dashboard.store');
Route::get('dashboard/{id}', [DashboardController::class, 'show'])->name('mentor.dashboard.show');
Route::get('dashboard/{id}/edit', [DashboardController::class, 'edit'])->name('mentor.dashboard.edit');
Route::put('dashboard/{id}', [DashboardController::class, 'update'])->name('mentor.dashboard.update');
Route::delete('dashboard/{id}', [DashboardController::class, 'destroy'])->name('mentor.dashboard.destroy');
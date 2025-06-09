<?php

use App\Http\Controllers\SavingGoalController;
use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('saving-goals.index');
});

// Dummy login route untuk mencegah error
Route::get('login', function () {
    return redirect()->route('auth.google'); // Redirect ke Google OAuth langsung
})->name('login');

// Google OAuth routes
Route::get('auth/google', [LoginController::class, 'redirectToGoogle'])->name('auth.google');
Route::get('auth/google/callback', [LoginController::class, 'handleGoogleCallback']);

// Logout
Route::post('logout', [LoginController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {
    Route::resource('saving-goals', SavingGoalController::class);
});

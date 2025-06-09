<?php

use App\Http\Controllers\SavingGoalController;
use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Route;

// Route redirect root ke halaman saving-goals index (yang butuh auth)
Route::get('/', function () {
    return redirect()->route('saving-goals.index');
});

// Routes untuk login/logout Google OAuth
Route::get('login', function () {
    return redirect()->route('auth.google'); // Redirect ke Google OAuth langsung
})->name('login');

Route::get('auth/google', [LoginController::class, 'redirectToGoogle'])->name('auth.google');
Route::get('auth/google/callback', [LoginController::class, 'handleGoogleCallback']);

Route::post('logout', [LoginController::class, 'logout'])->name('logout');

// Group route saving-goals dengan middleware auth, supaya hanya user login yang bisa akses
Route::middleware(['auth'])->group(function () {
    Route::resource('saving-goals', SavingGoalController::class);
});

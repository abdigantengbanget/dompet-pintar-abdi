<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\SavingGoalController;
use App\Http\Controllers\TransactionController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\EnsureProfileIsComplete;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// == RUTE UNTUK PENGGUNA YANG BELUM LOGIN (TAMU) ==
Route::middleware('guest')->group(function () {
    Route::get('login', function () {
        return view('auth.login');
    })->name('login');
    Route::post('login', [LoginController::class, 'login']);
    Route::get('auth/google', [LoginController::class, 'redirectToGoogle'])->name('auth.google');
    Route::get('auth/google/callback', [LoginController::class, 'handleGoogleCallback']);
});

// == AREA UNTUK PENGGUNA YANG SUDAH LOGIN ==
Route::middleware('auth')->group(function () {
    
    Route::post('logout', [LoginController::class, 'logout'])->name('logout');

    // --- Manajemen Profil Awal (Setup) ---
    Route::get('/profile/setup', [UserProfileController::class, 'setup'])->name('profile.setup');
    Route::post('/profile/store', [UserProfileController::class, 'store'])->name('profile.store');

    // --- Grup Rute yang Membutuhkan Profil Lengkap ---
    Route::middleware(EnsureProfileIsComplete::class)->group(function () {
        
        // --- DASBOR UTAMA ---
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

        // --- RUTE UNTUK SAVING GOALS ---
        // VVV INI RUTE BARU YANG DITAMBAHKAN VVV
        Route::post('/saving-goals/{savingGoal}/mark-as-saved', [SavingGoalController::class, 'markAsSaved'])->name('saving-goals.mark-as-saved');
        Route::resource('saving-goals', SavingGoalController::class)->except(['index', 'show']);
        
        // --- RUTE LAINNYA ---
        Route::resource('expenses', ExpenseController::class)->except(['index', 'show']);
        Route::get('/transactions/create/income', [TransactionController::class, 'createIncome'])->name('transactions.create_income');
        Route::resource('transactions', TransactionController::class)->except(['show']);
        Route::get('/profile', [UserProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [UserProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [UserProfileController::class, 'destroy'])->name('profile.destroy');
    });
});
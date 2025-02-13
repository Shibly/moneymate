<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

// Redirect default route ("/") to login page
Route::get('/', function () {
    return redirect()->route('login');
});

// Authentication Routes (Public)
Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);
Route::post('logout', [LoginController::class, 'logout'])->name('logout');
Route::get('forgot-password', [LoginController::class, 'forgotPassword'])->name('forgot-password');
// Protected Routes - Only Authenticated Users Can Access
Route::middleware(['auth'])->group(function () {

    Route::get('dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');

    Route::get('/profile', function () {
        return view('profile');
    });
});

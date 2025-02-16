<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CurrencyController;
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


    Route::group(['prefix' => 'categories'], function () {
        Route::get('/', [CategoryController::class, 'index'])->name('categories.index');
        Route::post('/store-category', [CategoryController::class, 'store'])->name('categories.store');
        Route::get('/edit/{category}', [CategoryController::class, 'edit'])->name('categories.edit');
        Route::post('/update/{category}', [CategoryController::class, 'update'])->name('categories.update');
        Route::post('/destroy/{category}', [CategoryController::class, 'destroy'])->name('categories.destroy');

    });

    Route::group(['prefix' => 'currencies'], function () {
        Route::get('/', [CurrencyController::class, 'index'])->name('currencies.index');
        Route::post('store-currency', [CurrencyController::class, 'store'])->name('currencies.store');
        Route::get('/edit/{currency}', [CurrencyController::class, 'show'])->name('currencies.edit');
        Route::post('/update/{currency}', [CurrencyController::class, 'update'])->name('currencies.update');
        Route::delete('/destroy/{currency}', [CurrencyController::class, 'destroy'])->name('currencies.destroy');

    });

});

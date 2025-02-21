<?php

use App\Http\Controllers\AccountTransferController;
use App\Http\Controllers\AttachmentController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\BankAccountController;
use App\Http\Controllers\BankNameController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CurrencyController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\IncomeController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\TranslationController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return redirect()->route('login');
});


Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);
Route::get('logout', [LoginController::class, 'logout'])->name('logout');
Route::get('forgot-password', [LoginController::class, 'forgotPassword'])->name('forgot-password');

Route::middleware(['auth'])->group(function () {


    Route::resource('languages', LanguageController::class);
    Route::get('language/translate/{code}', [TranslationController::class, 'edit'])->name('translations.edit');
    Route::post('/translations/ajax-update', [TranslationController::class, 'ajaxUpdate'])
        ->name('translations.ajaxUpdate');

    Route::get('languages/set-default/{code}', [LanguageController::class, 'setDefaultLanguage'])->name('language.setDefault');


    Route::get('dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');
    Route::get('/download/attachment/{filename}', [AttachmentController::class, 'download'])
        ->name('download.attachment');

    Route::get('private-files/{filename}', [AttachmentController::class, 'servePrivateFile'])
        ->name('private.files');


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

    Route::group(['prefix' => 'transfer'], function () {
        Route::get('balance', [AccountTransferController::class, 'balanceTransfer'])->name('transfer.balance');
        Route::post('store-balance-transfer', [AccountTransferController::class, 'storeBalanceTransfer'])->name('transfer.storeBalanceTransfer');

    });


    Route::group(['prefix' => 'banks'], function () {
        Route::get('/', [BankNameController::class, 'index'])->name('banks.index');
        Route::post('/store-bank', [BankNameController::class, 'store'])->name('banks.store');
        Route::get('/edit/{bank}', [BankNameController::class, 'show'])->name('banks.edit');
        Route::post('/update/{bank}', [BankNameController::class, 'update'])->name('banks.update');
        Route::post('/destroy/{bank}', [BankNameController::class, 'destroy'])->name('banks.destroy');
    });

    Route::group(['prefix' => 'accounts'], function () {
        Route::get('/', [BankAccountController::class, 'index'])->name('accounts.index');
        Route::post('/store-account', [BankAccountController::class, 'store'])->name('accounts.store');
        Route::get('/edit/{account}', [BankAccountController::class, 'show'])->name('accounts.edit');
        Route::post('/update/{account}', [BankAccountController::class, 'update'])->name('accounts.update');
        Route::post('/destroy/{account}', [BankAccountController::class, 'destroy'])->name('accounts.destroy');
    });


    Route::group(['prefix' => 'incomes'], function () {
        Route::get('/', [IncomeController::class, 'index'])->name('incomes.index');
        Route::post('/store-income', [IncomeController::class, 'store'])->name('incomes.store');
        Route::post('/destroy/{income}', [IncomeController::class, 'destroy'])->name('incomes.destroy');
    });


    Route::group(['prefix' => 'settings'], function () {
        Route::get('/', [SettingController::class, 'index'])->name('settings.index');
        Route::post('/update', [SettingController::class, 'update'])->name('settings.update');
        Route::get('/change-password', [ProfileController::class, 'index'])->name('profile.change-password');
        Route::post('/update-password', [ProfileController::class, 'updatePassword'])->name('profile.update-password');
        Route::get('/manage-profile', [ProfileController::class, 'manageProfile'])->name('profile.manage-profile');
        Route::post('/update-profile', [ProfileController::class, 'updateProfile'])->name('profile.update-profile');
    });

});

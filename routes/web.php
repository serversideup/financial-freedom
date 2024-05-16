<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\CashAccountController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CreditCardController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\InstitutionController;
use App\Http\Controllers\LoanController;
use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RulesController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\TransactionsController;
use App\Http\Controllers\TransactionsImportController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware(['auth'])->group( function(){
    Route::get('/', [DashboardController::class, 'index'])
        ->name('dashboard');
});

Route::middleware('auth')->group(function () {
    Route::post('/rules', [RulesController::class, 'store'])
        ->name('rules.store');

    Route::get('/transactions', [TransactionsController::class, 'index'])
        ->name('transactions.index');
    Route::post('/transactions', [TransactionsController::class, 'store'])
        ->name('transactions.store');

    Route::get('/transactions/import', [TransactionsImportController::class, 'index'])
        ->name('transactions.import.index');
    Route::post('/transactions/import', [TransactionsImportController::class, 'store'])
        ->name('transactions.import.store');

    Route::get('/accounts', [AccountController::class, 'index'])
        ->name('accounts.index');
    Route::post('/accounts', [AccountController::class, 'store'])
        ->name('accounts.store');

    Route::get('/credit-cards/{creditCard}', [CreditCardController::class, 'show'])
        ->name('credit-cards.show');
    Route::put('/credit-cards/{creditCard}', [CreditCardController::class, 'update'])
        ->name('credit-cards.update');

    Route::put('/loans/{loan}', [LoanController::class, 'update'])
        ->name('loans.update');

    Route::put('/cash-accounts/{cashAccount}', [CashAccountController::class, 'update'])
        ->name('cash-accounts.update');
        
    Route::get('/settings', [SettingsController::class, 'index'])
        ->name('settings.index');

    Route::put('/settings/portfolio', [PortfolioController::class, 'update'])
        ->name('settings.portfolio.update');

    Route::get('/settings/categories', [CategoryController::class, 'index'])
        ->name('settings.categories.index');
    Route::post('/settings/categories', [CategoryController::class, 'store'])
        ->name('settings.categories.store');
    Route::put('/settings/categories/{category}', [CategoryController::class, 'update'])
        ->name('settings.categories.update');
    Route::delete('/settings/categories/{category}', [CategoryController::class, 'destroy'])
        ->name('settings.categories.delete');
        
    Route::get('/settings/institutions', [InstitutionController::class, 'index'])
        ->name('settings.institutions.index');
    Route::post('/settings/institutions', [InstitutionController::class, 'store'])
        ->name('settings.institutions.store');
    Route::put('/settings/institutions/{institution}', [InstitutionController::class, 'update'])
        ->name('settings.institutions.update');
    Route::delete('/settings/institutions/{institution}', [InstitutionController::class, 'destroy'])
        ->name('settings.institutions.delete');
    
    
    
    
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

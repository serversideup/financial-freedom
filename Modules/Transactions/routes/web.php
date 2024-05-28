<?php

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

Route::middleware('auth')->group(function () {
    Route::get('/transactions', [TransactionsController::class, 'index'])
        ->name('transactions.index');
    Route::post('/transactions', [TransactionsController::class, 'store'])
        ->name('transactions.store');

    Route::get('/transactions/import', [TransactionsImportController::class, 'index'])
        ->name('transactions.import.index');
    Route::post('/transactions/import', [TransactionsImportController::class, 'store'])
        ->name('transactions.import.store');

});

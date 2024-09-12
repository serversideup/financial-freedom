<?php

use Illuminate\Support\Facades\Route;
use Modules\Transaction\Http\Controllers\ImportController;
use Modules\Transaction\Http\Controllers\TransactionController;
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
    Route::get('/transactions/import', [ImportController::class, 'index'])
        ->name('transactions.import.index');
    Route::post('/transactions/import', [ImportController::class, 'store'])
        ->name('transactions.import.store');

    Route::get('/transactions', [TransactionController::class, 'index'])
        ->name('transactions.index');
    Route::post('/transactions', [TransactionController::class, 'store'])
        ->name('transactions.store');
    Route::get('/transactions/{transaction}', [TransactionController::class, 'show'])
        ->name('transactions.show');
    Route::put('/transactions/{transaction}', [TransactionController::class, 'update'])
        ->name('transactions.update');
});

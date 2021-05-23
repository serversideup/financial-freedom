<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Web\Accounts\AccountsController;
use App\Http\Controllers\Web\CheckingAccounts\CheckingAccountsController;
use App\Http\Controllers\Web\SavingsAccounts\SavingsAccountsController;

use App\Http\Controllers\Web\Transactions\TransactionsController;
use App\Http\Controllers\Web\Transactions\TransactionsSplitsController;
use App\Http\Controllers\Web\Transactions\TransactionsReceiptController;

use App\Http\Controllers\Admin\Reports\AdminReportsController;
use App\Http\Controllers\Admin\Institutions\AdminInstitutionsController;
use App\Models\Accounts\Account;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/admin', [AdminReportsController::class, 'show']);

Route::get('/transactions', [TransactionsController::class, 'index']);
Route::get('/transactions/create', [TransactionsController::class, 'create']);
Route::get('/transactions/import', [TransactionsController::class, 'import']);
Route::get('/transactions/{transaction}', [TransactionsController::class, 'show']);
Route::post('/transactions', [TransactionsController::class, 'store']);
Route::put('/transactions/{transaction}', [TransactionsController::class, 'update']);

Route::post('/transactions/{transaction}/splits', [TransactionsSplitsController::class, 'store']);

Route::get('/transactions/{transaction}/receipt', [TransactionsReceiptController::class, 'show']);

Route::get('/accounts', [AccountsController::class, 'index']);
Route::get('/accounts/{account}/edit', [AccountsController::class, 'edit']);
Route::post('/accounts', [AccountsController::class, 'store']);

Route::get('/cash-accounts/{cashAccount}',[] );
Route::get('/credit-cards/{creditCard}', [] );
Route::get('/loans/{loan}', [LoanController::class]);
Route::get('/savings-accounts/{savingsAccount}', [SavingsAccountsController::class, 'show']);
Route::get('/checking-accounts/{checkingAccount}', [CheckingAccountsController::class, 'show']);

Route::get('/admin/institutions', [AdminInstitutionsController::class, 'show']);
Route::get('/admin/institutions/create', [AdminInstitutionsController::class, 'create']);
Route::get('/admin/institutions/{institution}/edit', [AdminInstitutionsController::class, 'edit']);
Route::post('/admin/institutions', [AdminInstitutionsController::class, 'store']);
Route::put('/admin/institutions/{institution}', [AdminInstitutionsController::class, 'update']);


Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return Inertia\Inertia::render('Dashboard');
})->name('dashboard');

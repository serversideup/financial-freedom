<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Web\Accounts\AccountsController;
use App\Http\Controllers\Web\Budgets\BudgetsController;
use App\Http\Controllers\Web\CheckingAccounts\CheckingAccountsController;
use App\Http\Controllers\Web\SavingsAccounts\SavingsAccountsController;
use App\Http\Controllers\Web\Loans\LoansController;
use App\Http\Controllers\Web\Cash\CashAccountsController;
use App\Http\Controllers\Web\CreditCards\CreditCardsController;
use App\Http\Controllers\Web\GiftCards\GiftCardsController;
use App\Http\Controllers\Web\Transactions\TransactionsController;
use App\Http\Controllers\Web\Transactions\TransactionsReceiptController;

use App\Http\Controllers\Admin\Reports\AdminReportsController;
use App\Http\Controllers\Admin\Transactions\AdminTransactionsController;
use App\Http\Controllers\Admin\Institutions\AdminInstitutionsController;

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

/**
 * Transactions Endpoints
 */
Route::get('/transactions', [TransactionsController::class, 'index']);
Route::get('/transactions/import', [TransactionsController::class, 'import']);
Route::get('/transactions/{transaction}', [TransactionsController::class, 'show']);
Route::get('/transactions/{transaction}/receipt', [TransactionsReceiptController::class, 'show']);

/**
 * @TODO: Convert to API only Endpoints
 */
Route::post('/transactions', [TransactionsController::class, 'store']);


Route::get('/accounts', [AccountsController::class, 'index']);
Route::get('/accounts/{account}/edit', [AccountsController::class, 'edit']);
Route::post('/accounts', [AccountsController::class, 'store']);

Route::get('/budgets', [BudgetsController::class, 'index']);

Route::get('/cash-accounts/{cashAccount}',[CashAccountsController::class, 'show'] );
Route::get('/credit-cards/{creditCard}', [CreditCardsController::class, 'show'] );

Route::get('/loans/{loan}', [LoansController::class, 'show']);

Route::get('/savings-accounts/{savingsAccount}', [SavingsAccountsController::class, 'show']);
Route::get('/checking-accounts/{checkingAccount}', [CheckingAccountsController::class, 'show']);

Route::get('/gift-cards/{giftCard}', [GiftCardsController::class, 'show']);

Route::get('/admin/transactions', [AdminTransactionsController::class, 'show']);
Route::get('/admin/transactions/categories', [AdminTransactionsController::class, 'categories']);
Route::get('/admin/transactions/tags', [AdminTransactionsController::class, 'tags']);
Route::get('/admin/transactions/rules', [AdminTransactionsController::class, 'rules']);

Route::get('/admin/institutions', [AdminInstitutionsController::class, 'show']);
Route::get('/admin/institutions/create', [AdminInstitutionsController::class, 'create']);
Route::get('/admin/institutions/{institution}/edit', [AdminInstitutionsController::class, 'edit']);
Route::post('/admin/institutions', [AdminInstitutionsController::class, 'store']);
Route::put('/admin/institutions/{institution}', [AdminInstitutionsController::class, 'update']);


Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return Inertia\Inertia::render('Dashboard');
})->name('dashboard');

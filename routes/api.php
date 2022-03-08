<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\API\Search\SearchController;
use App\Http\Controllers\API\Institutions\InstitutionsController;
use App\Http\Controllers\API\Transactions\TransactionsController;
use App\Http\Controllers\API\Accounts\AccountsController;
use App\Http\Controllers\API\Allocations\AllocationsController;
use App\Http\Controllers\API\Tags\TagsController;
use App\Http\Controllers\API\Categories\CategoriesController;

use App\Http\Controllers\API\CashAccounts\CashAccountsController;
use App\Http\Controllers\API\CashAccounts\CashAccountsAllocationsController;
use App\Http\Controllers\API\CashAccounts\CashAccountsTransactionsController;

use App\Http\Controllers\API\SavingsAccounts\SavingsAccountsController;
use App\Http\Controllers\API\SavingsAccounts\SavingsAccountsTransactionsController;

use App\Http\Controllers\API\CheckingAccounts\CheckingAccountsController;
use App\Http\Controllers\API\CheckingAccounts\CheckingAccountsAllocationsController;
use App\Http\Controllers\API\CheckingAccounts\CheckingAccountsTransactionsController;

use App\Http\Controllers\API\CreditCards\CreditCardsController;
use App\Http\Controllers\API\CreditCards\CreditCardsTransactionsController;

use App\Http\Controllers\API\GiftCards\GiftCardController;

use App\Http\Controllers\API\Loans\LoansController;
use App\Http\Controllers\API\Loans\LoansTransactionsController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

/**
 * Search Endpoints
 */
Route::post('/v1/search', [SearchController::class, 'index']);

/**
 * Institutions Endpoints
 */
Route::get('/v1/institutions', [InstitutionsController::class, 'index']);

/**
 * Accounts Endpoints
 */
Route::get('/v1/accounts', [AccountsController::class, 'index']);
Route::post('/v1/accounts', [AccountsController::class, 'store']);

/**
 * Savings Accounts Endpoints
 */
Route::get('/v1/savings-accounts/{savingsAccount}', [SavingsAccountsController::class, 'show']);
Route::put('/v1/savings-accounts/{savingsAccount}', [SavingsAccountsController::class, 'update']);
Route::get('/v1/savings-accounts/{savingsAccount}/transactions', [SavingsAccountsTransactionsController::class, 'index']);

/**
 * Cash Accounts Endpoints
 */
Route::get('/v1/cash-accounts/{cashAccount}', [CashAccountsController::class, 'show']);
Route::put('/v1/cash-accounts/{cashAccount}', [CashAccountsController::class, 'update']);
Route::post('/v1/cash-accounts', [CashAccountsController::class, 'store']);

Route::get('/v1/cash-accounts/{cashAccount}/allocations', [CashAccountsAllocationsController::class, 'index']);

Route::get('/v1/cash-accounts/{cashAccount}/transactions', [CashAccountsTransactionsController::class, 'index']);

/**
 * Checking Accounts Endpoints
 */
Route::get('/v1/checking-accounts/{checkingAccount}', [CheckingAccountsController::class, 'show']);
Route::put('/v1/checking-accounts/{checkingAccount}', [CheckingAccountsController::class, 'update']);
Route::post('/v1/checking-accounts', [CheckingAccountsController::class, 'store']);
Route::get('/v1/checking-accounts/{checkingAccount}/allocations', [CheckingAccountsAllocationsController::class, 'index']);
Route::get('/v1/checking-accounts/{checkingAccount}/transactions', [CheckingAccountsTransactionsController::class, 'index']);

/**
 * Loans Endpoints
 */
Route::get('/v1/loans/{loan}', [LoansController::class, 'show']);
Route::put('/v1/loans/{loan}', [LoansController::class, 'update']);

Route::get('/v1/loans/{loan}/transactions', [LoansTransactionsController::class, 'index']);

/**
 * Credit Cards Endpoints
 */
Route::get('/v1/credit-cards/{creditCard}', [CreditCardsController::class, 'show']);
Route::put('/v1/credit-cards/{creditCard}', [CreditCardsController::class, 'update']);
Route::get('/v1/credit-cards/{creditCard}/transactions', [CreditCardsTransactionsController::class, 'index']);

/**
 * Gift Card Endpoints
 */
Route::get('/v1/gift-cards/{giftCard}', [GiftCardController::class, 'show']);

/**
 * Allocation Endpoints
 */
Route::get('/v1/allocations', [AllocationsController::class, 'index']);
Route::post('/v1/allocations', [AllocationsController::class, 'store']);
Route::delete('/v1/allocations/{allocation}', [AllocationsController::class, 'delete']);
Route::put('/v1/allocations', [AllocationsController::class, 'update']);

/**
 * Transaction Endpoints
 */
Route::get('/v1/transactions', [TransactionsController::class, 'index']);
Route::get('/v1/transactions/{transaction}', [TransactionsController::class, 'show']);
Route::post('/v1/transactions/import', [TransactionsController::class, 'import']);
Route::post('/v1/transactions', [TransactionsController::class, 'store']);
Route::put('/v1/transactions/{transaction}', [TransactionsController::class, 'update']);
Route::post('/v1/transactions/{transaction}/splits', [TransactionsController::class, 'split']);
Route::delete('/v1/transactions/{transaction}/splits/{split}', [TransactionsController::class, 'deleteSplit']);

Route::get('/v1/tags', [TagsController::class, 'index']);
Route::put('/v1/tags/{tag}', [TagsController::class, 'update']);

Route::put('/v1/categories/{category}', [CategoriesController::class, 'update']);

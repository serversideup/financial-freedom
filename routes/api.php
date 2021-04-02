<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\API\Transactions\TransactionsController;
use App\Http\Controllers\API\Tags\TagsController;

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

Route::get('/v1/transactions', [TransactionsController::class, 'index']);
Route::post('/v1/transactions/import', [TransactionsController::class, 'import']);

Route::get('/v1/tags', [TagsController::class, 'index']);

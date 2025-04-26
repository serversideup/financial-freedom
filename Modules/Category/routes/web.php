<?php

use Illuminate\Support\Facades\Route;
use Modules\Category\Http\Controllers\CategoryController;
use Modules\Category\Http\Controllers\GroupController;

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

Route::prefix('settings/groups')->group(function () {
    Route::post('/', [GroupController::class, 'store'])->name('settings.groups.store');
    Route::put('/{group}', [GroupController::class, 'update'])->name('settings.groups.update');
});

Route::prefix('settings/categories')->group(function () {
    Route::get('/', [CategoryController::class, 'index'])->name('settings.categories.index');
    Route::post('/', [CategoryController::class, 'store'])->name('settings.categories.store');
    Route::put('/{category}', [CategoryController::class, 'update'])->name('settings.categories.update');
    Route::delete('/{category}', [CategoryController::class, 'destroy'])->name('settings.categories.delete');
});

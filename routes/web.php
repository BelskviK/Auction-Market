<?php

use Illuminate\Support\Facades\Route;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [App\Http\Controllers\MarketController::class, 'index'])->name('market.index');



Route::get('/market', [App\Http\Controllers\MarketController::class, 'index'])->name('market.index');

Route::get('/market/search-active-lot', [App\Http\Controllers\MarketController::class, 'searchActiveLot'])->name('market.searchActiveLot');

Route::get('/market/filter', [App\Http\Controllers\MarketController::class, 'filterLots'])->name('market.filter');

Route::get('/market/price-range', [App\Http\Controllers\MarketController::class, 'priceRange'])->name('market.priceRange');



Route::get('/lots', [App\Http\Controllers\LotController::class, 'index'])->name('lot.index');

Route::post('/lots/add', [App\Http\Controllers\LotController::class, 'addLot'])->name('lot.add');

Route::post('/lots/update', [App\Http\Controllers\LotController::class, 'updateLot'])->name('lot.update');

Route::post('/lots/delete', [App\Http\Controllers\LotController::class, 'deleteLot'])->name('lot.delete');

Route::post('/lots/{lot_id}/undo-delete', [App\Http\Controllers\LotController::class, 'undoDelete']);

Route::get('/lots/search', [App\Http\Controllers\LotController::class, 'searchlot'])->name('lot.search');

Route::get('/lots/filter', [App\Http\Controllers\LotController::class, 'filterLots'])->name('lot.filter');

Route::get('/lots/price-range', [App\Http\Controllers\LotController::class, 'priceRange'])->name('lot.pricerange');



Route::get('/categories', [App\Http\Controllers\CategoryController::class, 'index'])->name('category.index');

Route::post('/categories/add', [App\Http\Controllers\CategoryController::class, 'addCategory'])->name('category.add');

Route::post('/categories/update', [App\Http\Controllers\CategoryController::class, 'updateCategory'])->name('category.update');

Route::post('/categories/delete', [App\Http\Controllers\CategoryController::class, 'deleteCategory'])->name('category.delete');

Route::post('/categories/{category_id}/undo-delete', [App\Http\Controllers\CategoryController::class, 'undoDelete'])->name('category.undodelete');

Route::get('/categories/search', [App\Http\Controllers\CategoryController::class, 'searchCategory'])->name('category.search');



Route::post('/Bi/{lot}', [App\Http\Controllers\BidController::class, 'store'])->name('bid.store');

Route::get('/bid', [App\Http\Controllers\BidController::class, 'show'])->name('bid.show');

Route::post('/bid/delete', [App\Http\Controllers\BidController::class, 'delete'])->name('bid.delete');



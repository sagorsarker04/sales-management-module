<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\TrashController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
// Explicit CRUD routes for sales (equivalent to Route::resource('sales', SaleController::class))
Route::get('sales', [SaleController::class, 'index'])->name('sales.index');
Route::get('sales/create', [SaleController::class, 'create'])->name('sales.create');
Route::post('sales', [SaleController::class, 'store'])->name('sales.store');
Route::get('sales/{sale}', [SaleController::class, 'show'])->name('sales.show');
Route::get('sales/{sale}/edit', [SaleController::class, 'edit'])->name('sales.edit');
Route::match(['put', 'patch'], 'sales/{sale}', [SaleController::class, 'update'])->name('sales.update');
Route::delete('sales/{sale}', [SaleController::class, 'destroy'])->name('sales.destroy');
Route::get('products/{id}/price', [ProductController::class, 'getPrice'])->name('products.price');

Route::prefix('trash')->name('trash.')->group(function () {
    Route::get('/', [TrashController::class, 'index'])->name('index');
    Route::post('/{id}/restore', [TrashController::class, 'restore'])->name('restore');
});

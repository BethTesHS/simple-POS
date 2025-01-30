<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PosController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\SaleDetailController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('calc', function () {
    return view('calc');
});


// Route::resource('pos', ProductController::class);

Route::get('get-sale-details', [SaleDetailController::class, 'showSaleDetail'])->name('salesDetail');

Route::get('pos', [PosController::class, 'index'])->name('pos');
Route::get('sales', [PosController::class, 'sales'])->name('sales');
Route::get('products', [PosController::class, 'products'])->name('products');

Route::post('storeSale', [SaleController::class, 'storeSale'])->name('sales.storeSale');
Route::post('storeSaleDetail', [SaleController::class, 'storeSaleDetail'])->name('sales.storeSaleDetail');

Route::get('productSearch', [ProductController::class, 'searchProducts'])->name('products.search');
Route::get('productShowAll', [ProductController::class, 'showProducts'])->name('products.all');
Route::get('productShowOne', [ProductController::class, 'showProduct'])->name('products.one');
Route::get('productFilter', [ProductController::class, 'filterProduct'])->name('products.filter');
Route::post('products', [ProductController::class, 'store'])->name('products.store');
Route::put('products', [ProductController::class, 'update'])->name('products.update');
Route::delete('products', [ProductController::class, 'delete'])->name('products.delete');

Route::post('categories', [CategoryController::class, 'store'])->name('categories.store');

Route::get('testSearch', [ProductController::class, 'searchTest'])->name('test.search');
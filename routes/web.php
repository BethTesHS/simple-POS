<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ProductController;
use App\Http\Controllers\PosController;
use App\Http\Controllers\SaleController;

Route::get('/', function () {
    return view('welcome');
});
// Route::get('pos', function () {
//     return view('pos');
// });
Route::get('calc', function () {
    return view('calc');
});


// Route::resource('pos', ProductController::class);

Route::get('pos', [PosController::class, 'show'])->name('pos');
Route::post('products', [ProductController::class, 'store'])->name('products.store');
Route::put('products', [ProductController::class, 'update'])->name('products.update');
Route::delete('products', [ProductController::class, 'delete'])->name('products.delete');
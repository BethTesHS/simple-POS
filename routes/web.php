<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ProductController;
use App\Http\Controllers\SaleController;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/pos', function () {
    return view('pos');
});



Route::resource('products', ProductController::class);
Route::resource('sales', SaleController::class);


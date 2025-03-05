<?php

use App\Http\Controllers\PartialController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegisterController;

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PosController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\SaleDetailController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CustomerController;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('calc', function () {
    return view('calc');
});

Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);

Route::post('logout', [LogoutController::class, 'logout'])->name('logout');

Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [RegisterController::class, 'register']);


Route::middleware(['auth'])->group(function () {

    Route::get('/get-sale-details', [SaleDetailController::class, 'showSaleDetail'])->name('salesDetail');

    Route::get('/pos', [PosController::class, 'index'])->name('pos');
    Route::get('/', [PosController::class, 'index'])->name('pos');
    Route::get('/sales', [PosController::class, 'sales'])->name('sales');
    Route::get('/products', [PosController::class, 'products'])->name('products');
    Route::get('/stocks', [PosController::class, 'stocks'])->name('stocks');
    Route::get('/partialPayments', [PosController::class, 'partial'])->name('partial');
    Route::get('/customers', [PosController::class, 'customers'])->name('customers');
    Route::get('/users', [PosController::class, 'users'])->name('users');
    Route::get('/analysis', [PosController::class, 'analysis'])->name('analysis');

    Route::post('/storeSale', [SaleController::class, 'storeSale'])->name('sales.storeSale');
    Route::post('/storePartialSale', [SaleController::class, 'storePartialSale'])->name('sales.storePartialSale');
    Route::post('/storeSaleDetail', [SaleController::class, 'storeSaleDetail'])->name('sales.storeSaleDetail');

    Route::get('/productSearch', [ProductController::class, 'searchProducts'])->name('products.search');
    Route::get('/productShowAll', [ProductController::class, 'showProducts'])->name('products.all');
    Route::get('/productShowOne', [ProductController::class, 'showProduct'])->name('products.one');
    Route::get('/productFilter', [ProductController::class, 'filterProduct'])->name('products.filter');
    Route::post('/products', [ProductController::class, 'store'])->name('products.store');
    Route::put('/products', [ProductController::class, 'update'])->name('products.update');
    Route::delete('/products', [ProductController::class, 'delete'])->name('products.delete');

    Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store');

    Route::post('/stockUp', [StockController::class, 'update'])->name('stocks.update');

    Route::get('/testSearch', [ProductController::class, 'searchTest'])->name('test.search');

    Route::put('/users', [UserController::class, 'update'])->name('users.update');
    Route::delete('/users', [UserController::class, 'delete'])->name('users.delete');

    Route::post('/customers', [CustomerController::class, 'store'])->name('customers.store');
    Route::put('/customers', [CustomerController::class, 'update'])->name('customers.update');
    Route::delete('/customers', [CustomerController::class, 'delete'])->name('customers.delete');

    Route::post('/storePartial', [PartialController::class, 'store'])->name('partial.store');

});

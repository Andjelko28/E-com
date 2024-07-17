<?php

use App\Http\Controllers\SessionController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AllProductsController;
use App\Http\Controllers\BrandsController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\RegisteredUserController;

// Routes for user
Route::post('/login', [SessionController::class, 'login']);
Route::post('/register', [RegisteredUserController::class, 'register']);
Route::post('/logout', [SessionController::class, 'destroy']);

// Categories and brands POST
Route::post('/categories', [CategoryController::class, 'store']);
Route::post('/brands', [BrandsController::class, 'store']);
Route::post('/products', [AllProductsController::class, 'store']);


// Categories and brands GET
Route::get('/categories', [CategoryController::class, 'index']);
Route::get('/brands', [BrandsController::class, 'index']);
Route::get('/products', [AllProductsController::class, 'index']);


// Cart
Route::middleware(['auth:api'])->group(function () {
    Route::get('/cart', [CartController::class, 'index']);
    Route::post('/cart', [CartController::class, 'store']);
    Route::get('/cart/items-count', [CartController::class, 'getItemCount']);
    Route::get('/cart/items', [CartController::class, 'getCartItems']);
    Route::put('/cart/{id}', [CartController::class, 'update']);
    Route::delete('/cart/{id}', [CartController::class, 'destroy']);
});

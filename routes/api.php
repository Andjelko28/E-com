<?php

use App\Http\Controllers\SessionController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AllProductsController;
use App\Http\Controllers\BrandsController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\RegisteredUserController;

Route::post('/login', [SessionController::class, 'login']);
Route::post('/register', [RegisteredUserController::class, 'register']);
Route::post('/logout', [SessionController::class, 'destroy']);


Route::post('/categories', [CategoryController::class, 'store']);
Route::post('/brands', [BrandsController::class, 'store']);
Route::post('/products', [AllProductsController::class, 'store']);

Route::get('/categories', [CategoryController::class, 'index']);
Route::get('/brands', [BrandsController::class, 'index']);
Route::get('/products', [AllProductsController::class, 'index']);

Route::middleware('auth:passport')->group(function () {
    Route::get('/cart', [CartController::class, 'index']);
    Route::post('/cart', [CartController::class, 'store']);
    Route::put('/cart/{id}', [CartController::class, 'update']);
    Route::delete('/cart/{id}', [CartController::class, 'destroy']);
});

<?php

use App\Http\Controllers\SessionController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AllProductsController;
use App\Http\Controllers\BrandsController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\RegisteredUserController;

Route::post('/login', [SessionController::class, 'login']);
Route::post('/register', [RegisteredUserController::class, 'register']);
Route::post('/logout', [SessionController::class, 'destroy']);


Route::post('/categories', [CategoryController::class, 'store']);
Route::post('/brands', [CategoryController::class, 'store']);
Route::post('/products', [CategoryController::class, 'store']);

Route::get('/categories', [CategoryController::class, 'index']);
Route::get('/brands', [BrandsController::class, 'index']);
Route::get('/products', [AllProductsController::class, 'index']);

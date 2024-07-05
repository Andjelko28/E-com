<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AllProductsController;
use App\Http\Controllers\BrandsController;
use App\Http\Controllers\CategoryController;

Route::get('/categories', [CategoryController::class, 'index']);
Route::get('/brands', [BrandsController::class, 'index']);
Route::get('/products', [AllProductsController::class, 'index']);

<?php


use App\Http\Controllers\AllProductsController;
use App\Http\Controllers\BrandsController;
use App\Http\Controllers\CategoryController;

Route::get('/categories', [CategoryController::class, 'index']);
Route::get('/brands', [BrandsController::class, 'index']);

Route::get('/products', [AllProductsController::class, 'index']);
Route::get('/products/category/{categoryId}', [AllProductsController::class, 'getByCategory']);
Route::get('/products/brand/{brandId}', [AllProductsController::class, 'getByBrand']);

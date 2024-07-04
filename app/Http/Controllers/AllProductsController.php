<?php

namespace App\Http\Controllers;

use App\Models\Products;
use Illuminate\Http\Request;

class AllProductsController extends Controller
{
    public function index()
    {
        return Products::all();
    }

    public function getByCategory($categoryId)
    {
        return Products::where('category_id', $categoryId)->get();
    }

    public function getByBrand($brandId)
    {
        return Products::where('brand_id', $brandId)->get();
    }
}

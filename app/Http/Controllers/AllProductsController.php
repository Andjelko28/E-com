<?php

namespace App\Http\Controllers;

use App\Models\Products;
use Illuminate\Http\Request;

class AllProductsController extends Controller
{
    public function index()
    {
        $products  = Products::all();
        return response()->json($products);
    }

    public function store(Request $request)
    {
        $attributes =  $request->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required',
            'stock' => 'required',
            'image_path' => 'nullable|string'
        ]);

        $product = Products::create($request->all());

        $product->save();

        return response()->json(['message' => 'Product created successfully']);
    }
}

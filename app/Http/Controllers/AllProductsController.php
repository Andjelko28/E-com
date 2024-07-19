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
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $product = Products::create($request->all());

        $attributes['image'] = request()->file('image')->store('images');

        $product->save();

        return response()->json(['message' => 'Product created successfully']);
    }
}

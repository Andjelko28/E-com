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
            'category_id' => 'required|exists:categories,id',
            'brand_id' => 'required|exists:brands,id',
            'name' => 'required',
            'description' => 'required',
            'price' => 'required',
            'stock' => 'required',
            'image_path' => 'nullable|string'
        ]);
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('images', 'public');
            $attributes['image_path'] = $path; // Save the image path to the attributes
        }
        $product = Products::create($attributes);

        $product->save();

        return response()->json(['message' => 'Product created successfully']);
    }
}

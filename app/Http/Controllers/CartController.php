<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    public function index()
    {
        $cart = Cart::where('user_id', Auth::id())->with('items.product')->first();
        return response()->json($cart);
    }

    public function store(Request $request)
    {
        $user_id = Auth::id();

        $cart = Cart::firstOrCreate(['user_id' => $user_id]);

        $cartItem = CartItem::updateOrCreate(
            ['cart_id' => $cart->id, 'product_id' => $request->product_id],
            ['quantity' => DB::raw("quantity + {$request->quantity}")] // Can add one product more then one time...
        );
        $totalItems = CartItem::where('cart_id', $cart->id)->sum('quantity');


        return response()->json([
            'cartItem' => $cartItem,
            'totalItems' => $totalItems
        ]);
    }

    public function getItemCount()
    {
        $user_id = Auth::id();

        $cart = Cart::firstOrCreate(['user_id' => $user_id]);
        $totalItems = CartItem::where('cart_id', $cart->id)->sum('quantity');

        return response()->json([
            'totalItems' => $totalItems
        ]);
    }

    public function getCartItems()
    {
        $user_id = Auth::id();
        $cart = Cart::firstOrCreate(['user_id' => $user_id]);
        $cartItems = CartItem::where('cart_id', $cart->id)
            ->with('product')
            ->get();

        return response()->json($cartItems);
    }

    public function update(Request $request, $id)
    {
        $cartItem = CartItem::find($id);
        $cartItem->quantity = $request->quantity;
        $cartItem->save();

        return response()->json($cartItem);
    }

    public function destroy($id)
    {
        CartItem::destroy($id);
        return response()->json(['message' => 'Item removed']);
    }
}

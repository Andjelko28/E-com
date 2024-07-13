<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
            ['card_id' => $cart->id, 'product_id' => $request->product_id],
            ['quantity' => $request->quantity]
        );
        return response()->json($cartItem);
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

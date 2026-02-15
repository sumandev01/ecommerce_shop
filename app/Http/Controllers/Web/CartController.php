<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function cart()
    {
        $userId = auth('web')->user()->id;
        $cartItems = Cart::where('user_id', $userId)->get();
        $cartItemsCount = Cart::where('user_id', $userId)->count();
        return view('web.cart', compact('cartItems', 'cartItemsCount'));
    }

    public function addToCart(Request $request)
    {
        $userId = auth('web')->user()->id;
        if (!$userId) {
            return view('auth.login')->with('error', 'Please login first');
        };

        if (Cart::where('user_id', $userId)->where('product_id', $request->product_id)->where('product_inventory_id', $request->inventoryId)->exists()) {
            $cart = Cart::where('user_id', $userId)->where('product_id', $request->product_id)->where('product_inventory_id', $request->inventoryId)->first();
            $cart->quantity = $cart->quantity + $request->quantity;
            $cart->save();
            return back()->with('success', 'Product added to cart successfully');
        } else {
            $cart = Cart::create([
                'user_id' => $userId,
                'product_id' => $request->product_id,
                'product_inventory_id' => $request->inventoryId ?? null, 
                'color_id' => $request->color ?? null,
                'size_id' => $request->size ?? null,
                'quantity' => $request->quantity,
            ]);
        }

        return back()->with('success', 'Product added to cart successfully');
    }

    public function updateCart(Request $request)
    {
        $cart = Cart::find($request->id);
        $cart->quantity = $request->quantity;
        $cart->save();
        return back()->with('success', 'Product quantity updated successfully');
    }

    public function destroy(Cart $cart)
    {
        $cart->delete();
        return back()->with('success', 'Product removed from cart successfully');
    }
}

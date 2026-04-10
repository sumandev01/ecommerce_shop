<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Coupon;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function cart()
    {
        $userId = auth('web')->user()->id;
        $cartItems = Cart::where('user_id', $userId)->get();
        $cartItemsCount = Cart::where('user_id', $userId)->count();
        $totalPrice = $cartItems->map(function ($cartItem) {
            $price = $cartItem->product->discount_price > 0 ? $cartItem->product->discount_price : $cartItem->product->price;
            return $price * $cartItem->quantity;
        })->sum();
        return view('web.cart', compact('cartItems', 'cartItemsCount', 'totalPrice'));
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

    public function applyCoupon(Request $request)
    {
        $request->validate([
            'coupon_code' => 'required|string',
            'amount' => 'required|numeric',
        ]);

        $discountPrice = 0;

        $couponCode = $request->coupon_code;

        $coupon = Coupon::where('coupon_code', $couponCode)->where('status', 1)->first();
        
        if (!$coupon) {
            return response()->json([
                'status' => 'error',
                'message' => 'Coupon not found',
            ], 404);
        }

        $isValid = now()->between($coupon->start_date, $coupon->end_date);

        if (!$isValid) {
            return response()->json([
                'status' => 'error',
                'message' => 'Coupon is not valid',
            ], 400);
        }

        $hasLimit = ($coupon->limit - $coupon->total_apply) > 0;
        if (!$hasLimit) {
            return response()->json([
                'status' => 'error',
                'message' => 'Coupon limit exceeded',
            ], 400);
        }

        $minAmount = $coupon->min_amount;
        if ($request->amount < $minAmount) {
            return response()->json([
                'status' => 'error',
                'message' => 'Minimum amount not met',
            ], 400);
        }

        $couponDiscount = 0;
        if ($coupon->coupon_type == 'fixed') {
            $couponDiscount = $coupon->discount;
        } else {
            $couponDiscount = ($request->amount * $coupon->discount) / 100;
        }

        $discountPrice = $request->amount - $couponDiscount;

        return response()->json([
            'status' => 'success',
            'message' => 'Coupon applied successfully',
            'couponId' => $coupon->id,
            'discountPrice' => $discountPrice,
        ]);
    }
}
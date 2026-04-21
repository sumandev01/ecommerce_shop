<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function index(Request $request)
    {
        $user = auth('web')->user();
        $couponId = $request->coupon_id;
        $coupon = null;
        if ($couponId) {
            $coupon = Coupon::find($couponId);
        }
        $cartItems = $user->cartItems;

        $subTotal = $cartItems->map(function ($cartItem) {
            $price = $cartItem->product->discount_price > 0 ? $cartItem->product->discount_price : $cartItem->product->price;
            return $price * $cartItem->quantity;
        })->sum();
        

        $couponDiscount = 0;
        if ($coupon) {
            if ($coupon->coupon_type == 'fixed') {
                $couponDiscount = $coupon->discount;
            } else {
                $couponDiscount = ($subTotal * $coupon->discount) / 100;
            }
        }
        if ($couponDiscount > $subTotal) {
            $couponDiscount = $subTotal;
        }
        $grandTotal = $subTotal - $couponDiscount;

        return view('web.checkout', compact('user', 'coupon', 'cartItems', 'couponDiscount', 'subTotal', 'grandTotal'));
    }
}

<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\OrderRequest;
use App\Models\Coupon;
use App\Models\OrderProduct;
use App\Models\Product;
use App\Models\ProductInventory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function store(OrderRequest $request)
    {
        dd($request->all());
        $user = auth('web')->user();

        $cartItems = $user->cartItems;

        // price is computed per item when inserting
        $couponId = session()->get('coupon_id');
        $coupon = null;
        if ($couponId) {
            $coupon = Coupon::find($couponId);

            if ($coupon) {
                $isStatusActive = $coupon->status == 1;
                $isNotExpired = now()->between($coupon->start_date, $coupon->end_date);
                $hasLimit = ($coupon->limit - $coupon->total_apply) > 0;

                if (!$isStatusActive) {
                    session()->forget('coupon_id');
                    return back()->with('error', 'Coupon is not active');
                }

                if (!$isNotExpired) {
                    session()->forget('coupon_id');
                    return back()->with('error', 'Coupon is expired');
                }

                if (!$hasLimit) {
                    session()->forget('coupon_id');
                    return back()->with('error', 'Coupon usage limit reached');
                }

                $coupon->increment('total_apply');
            }
        }
        $orderId = 1;
        foreach ($cartItems as $cartItem) {
            $price = $cartItem->product->discount_price > 0
                ? $cartItem->product->discount_price
                : $cartItem->product->price;

            OrderProduct::create([
                'order_id'   => $orderId,
                'product_id' => $cartItem->product_id,
                'size_id'    => $cartItem->size_id,
                'color_id'   => $cartItem->color_id,
                'quantity'   => $cartItem->quantity,
                'price'      => $price,
            ]);
        };

        return redirect()->route('cart')->with('success', 'Order placed successfully');
    }
}

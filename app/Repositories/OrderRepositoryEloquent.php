<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\OrderRepository;
use App\Models\Order;
use App\Enums\Enums\OrderStatusEnums;
use App\Models\BillingAddress;
use App\Models\Coupon;
use App\Models\ShippingAddress;
use App\Validators\OrderValidator;
use GrahamCampbell\ResultType\Success;
use Illuminate\Support\Facades\DB;

/**
 * Class OrderRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class OrderRepositoryEloquent extends BaseRepository implements OrderRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Order::class;
    }



    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    public static function storeByRequest($request, $user)
    {
        $cartItems = $user->cartItems;

        if ($cartItems->isEmpty()) {
            throw new \Exception('Your cart is empty.');
        }

        $subTotal = $cartItems->sum(function ($cartItem) {
            $price = $cartItem->product->discount_price > 0
                ? $cartItem->product->discount_price
                : $cartItem->product->price;
            return $price * $cartItem->quantity;
        });

        $couponId = $request->couponId;
        $coupon = null;
        $couponDiscount = 0;

        if ($couponId) {
            $coupon = Coupon::find($couponId);

            if ($coupon) {
                $isStatusActive = $coupon->status == 1;
                $isNotExpired = now()->between($coupon->start_date, $coupon->end_date);
                $hasLimit = ($coupon->limit - $coupon->total_apply) > 0;

                if (!$isStatusActive) {
                    session()->forget('coupon_id');
                    throw new \Exception('Coupon is inactive.');
                }

                if (!$isNotExpired) {
                    session()->forget('coupon_id');
                    throw new \Exception('Coupon is expired.');
                }

                if (!$hasLimit) {
                    session()->forget('coupon_id');
                    throw new \Exception('Coupon usage limit reached.');
                }

                $couponDiscount = $coupon->coupon_type == 'fixed'
                    ? $coupon->discount
                    : ($subTotal * $coupon->discount) / 100;

                if ($couponDiscount > $subTotal) {
                    $couponDiscount = $subTotal;
                }
            }
        }

        $totalPrice = ($subTotal - $couponDiscount) + $request->charge;

        return DB::transaction(function () use ($request, $user, $cartItems, $couponId, $coupon, $couponDiscount, $totalPrice) {

            $orderCode = '';
            do {
                $id = str_pad(random_int(10000, 99999), 5, '0', STR_PAD_LEFT);
                $orderCode = '#ORD-' . $id;
                $exists = Order::where('order_code', $orderCode)->first();
            } while ($exists);

            $order = Order::create([
                'order_code'     => $orderCode,
                'user_id'        => $user->id,
                'charge'         => $request->charge,
                'total_price'    => $totalPrice,
                'has_coupon'     => $coupon ? true : false,
                'coupon_id'      => $couponId,
                'coupon_discount' => $couponDiscount,
                'status'         => OrderStatusEnums::PENDING->value,
                'payment_method' => $request->payment_method,
                'has_payment'    => false,
                'message'        => $request->message,
            ]);

            BillingAddressRepositoryEloquent::storeByRequest($request, $order, $user);
            ShippingAddressRepositoryEloquent::storeByRequest($request, $order, $user);
            OrderProductRepositoryEloquent::storeByOrderAndCartItems($order, $cartItems);

            if ($coupon) {
                $coupon->increment('total_apply');
            }

            $cartItems->each->delete();

            return $order;
        });
    }
}

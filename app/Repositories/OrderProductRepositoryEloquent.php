<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\OrderProductRepository;
use App\Models\OrderProduct;
use App\Validators\OrderProductValidator;

/**
 * Class OrderProductRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class OrderProductRepositoryEloquent extends BaseRepository implements OrderProductRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return OrderProduct::class;
    }



    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    public static function storeByOrderAndCartItems($order, $cartItems)
    {
        foreach ($cartItems as $cartItem) {
            $price = $cartItem->product->discount_price > 0
                ? $cartItem->product->discount_price
                : $cartItem->product->price;

            OrderProduct::create([
                'order_id'   => $order->id,
                'product_id' => $cartItem->product_id,
                'size_id'    => $cartItem->size_id,
                'color_id'   => $cartItem->color_id,
                'quantity'   => $cartItem->quantity,
                'price'      => $price,
            ]);
        };
    }
}

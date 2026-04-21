<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $guarded = ['id'];

    protected $casts = [
        'status' => \App\Enums\Enums\OrderStatusEnums::class,
    ];

    public function order_products()
    {
        return $this->hasMany(OrderProduct::class);
    }
}

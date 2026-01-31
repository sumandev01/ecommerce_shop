<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Color extends Model
{
    protected $guarded = ['id'];

    public function colors()
    {
        return $this->hasManyThrough(
            Product::class,            // The final model you want to access
            ProductInventory::class,   // The intermediate model (the bridge)
            'color_id',                // Foreign key on the product_inventories table
            'id',                      // Foreign key on the products table
            'id',                      // Local key on the colors table
            'product_id'               // Local key on the product_inventories table
        );
    }
}

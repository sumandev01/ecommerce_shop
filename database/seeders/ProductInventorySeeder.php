<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ProductInventory;

class ProductInventorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'product_id' => 1,
                'size_id' => 1,
                'color_id' => 1,
                'quantity' => 100,
            ],
            [
                'product_id' => 1,
                'size_id' => 2,
                'color_id' => 1,
                'quantity' => 150,
            ],
            [
                'product_id' => 2,
                'size_id' => 2,
                'color_id' => 1,
                'quantity' => 200,
            ],
            [
                'product_id' => 2,
                'size_id' => 3,
                'color_id' => 1,
                'quantity' => 250,
            ],
            [
                'product_id' => 3,
                'size_id' => 1,
                'color_id' => 2,
                'quantity' => 300,
            ],
            [
                'product_id' => 3,
                'size_id' => 2,
                'color_id' => 2,
                'quantity' => 350,
            ],
            [
                'product_id' => 4,
                'size_id' => 2,
                'color_id' => 2,
                'quantity' => 400,
            ],
            [
                'product_id' => 4,
                'size_id' => 3,
                'color_id' => 2,
                'quantity' => 450,
            ],
            [
                'product_id' => 5,
                'size_id' => 1,
                'color_id' => 3,
                'quantity' => 500,
            ],
            [
                'product_id' => 5,
                'size_id' => 2,
                'color_id' => 3,
                'quantity' => 550,
            ],
            [
                'product_id' => 6,
                'size_id' => 2,
                'color_id' => 3,
                'quantity' => 600,
            ],
            [
                'product_id' => 6,
                'size_id' => 3,
                'color_id' => 3,
                'quantity' => 650,
            ],
            [
                'product_id' => 7,
                'size_id' => 1,
                'color_id' => 1,
                'quantity' => 700,
            ],
            [
                'product_id' => 7,
                'size_id' => 2,
                'color_id' => 1,
                'quantity' => 750,
            ],
            [
                'product_id' => 8,
                'size_id' => 2,
                'color_id' => 1,
                'quantity' => 800,
            ],
            [
                'product_id' => 8,
                'size_id' => 3,
                'color_id' => 1,
                'quantity' => 850,
            ],
            [
                'product_id' => 9,
                'size_id' => 1,
                'color_id' => 2,
                'quantity' => 900,
            ],
            [
                'product_id' => 9,
                'size_id' => 2,
                'color_id' => 2,
                'quantity' => 950,
            ],
        ];
        foreach ($data as $inventory) {
            ProductInventory::updateOrCreate(
                [
                    'product_id' => $inventory['product_id'],
                    'size_id' => $inventory['size_id'],
                    'color_id' => $inventory['color_id'],
                ],
                [
                    'quantity' => $inventory['quantity'],
                ]
            );
        }
    }
}

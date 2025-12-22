<?php

namespace Database\Seeders;

use App\Models\ProductDetails;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;


class ProductDetailsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ProductDetails::query()->delete();
        $data = [
            [
                'id' => 1,
                'product_id' => 1,
                'product_id' => 1,
                'category_id' => 1,
                'sub_category_id' => 1,
                'short_description' => 'The iPhone 13 is a sleek and powerful smartphone from Apple.',
                'long_description' => 'The iPhone 13 features a sleek design, advanced dual-camera system, and A15 Bionic chip for exceptional performance.',
                'additional_info' => '',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 2,
                'product_id' => 2,
                'product_id' => 2,
                'category_id' => 2,
                'sub_category_id' => 2,
                'short_description' => 'The iPhone 13 is a sleek and powerful smartphone from Apple.',
                'long_description' => 'The iPhone 13 features a sleek design, advanced dual-camera system, and A15 Bionic chip for exceptional performance.',
                'additional_info' => '',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 3,
                'product_id' => 3,
                'product_id' => 3,
                'category_id' => 3,
                'sub_category_id' => 3,
                'short_description' => 'The iPhone 13 is a sleek and powerful smartphone from Apple.',
                'long_description' => 'The iPhone 13 features a sleek design, advanced dual-camera system, and A15 Bionic chip for exceptional performance.',
                'additional_info' => '',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 4,
                'product_id' => 4,
                'product_id' => 4,
                'category_id' => 4,
                'sub_category_id' => 4,
                'short_description' => 'The iPhone 13 is a sleek and powerful smartphone from Apple.',
                'long_description' => 'The iPhone 13 features a sleek design, advanced dual-camera system, and A15 Bionic chip for exceptional performance.',
                'additional_info' => '',
                'created_at' => now(),
                'updated_at' => now()
            ],
        ];
        ProductDetails::insert($data);
    }
}

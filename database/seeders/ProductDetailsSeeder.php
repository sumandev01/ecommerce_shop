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
        $data = [
            [
                'product_id' => 1,
                'category_id' => 1,
                'sub_category_id' => 1,
                'short_description' => 'The iPhone 13 is a sleek and powerful smartphone from Apple.',
                'long_description' => 'The iPhone 13 features a sleek design, advanced dual-camera system, and A15 Bionic chip for exceptional performance.',
                'additional_info' => '',
            ],
            [
                'product_id' => 2,
                'category_id' => 2,
                'sub_category_id' => 2,
                'short_description' => 'The iPhone 13 is a sleek and powerful smartphone from Apple.',
                'long_description' => 'The iPhone 13 features a sleek design, advanced dual-camera system, and A15 Bionic chip for exceptional performance.',
                'additional_info' => '',
            ],
            [
                'product_id' => 3,
                'category_id' => 3,
                'sub_category_id' => 3,
                'short_description' => 'The iPhone 13 is a sleek and powerful smartphone from Apple.',
                'long_description' => 'The iPhone 13 features a sleek design, advanced dual-camera system, and A15 Bionic chip for exceptional performance.',
                'additional_info' => '',
            ],
            [
                'product_id' => 4,
                'category_id' => 4,
                'sub_category_id' => 4,
                'short_description' => 'The iPhone 13 is a sleek and powerful smartphone from Apple.',
                'long_description' => 'The iPhone 13 features a sleek design, advanced dual-camera system, and A15 Bionic chip for exceptional performance.',
                'additional_info' => '',
            ],
            [
                'product_id' => 5,
                'category_id' => 5,
                'sub_category_id' => 5,
                'short_description' => 'The iPhone 13 is a sleek and powerful smartphone from Apple.',
                'long_description' => 'The iPhone 13 features a sleek design, advanced dual-camera system, and A15 Bionic chip for exceptional performance.',
                'additional_info' => '',
            ],
            [
                'product_id' => 6,
                'category_id' => 6,
                'sub_category_id' => 6,
                'short_description' => 'The iPhone 13 is a sleek and powerful smartphone from Apple.',
                'long_description' => 'The iPhone 13 features a sleek design, advanced dual-camera system, and A15 Bionic chip for exceptional performance.',
                'additional_info' => '',
            ],
        ];
        foreach ($data as $productDetails) {
            ProductDetails::updateOrCreate(
                ['product_id' => $productDetails['product_id']],
                $productDetails
            );
        }
    }
}

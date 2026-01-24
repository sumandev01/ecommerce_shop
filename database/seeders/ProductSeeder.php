<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'name' => 'iPhone 13',
                'slug' => 'iphone-13',
                'sku_code' => 'IP13-001',
                'price' => 799.99,
                'buy_price' => 699.99,
                'discount_price' => 749.99,
                'reviews' => 150,
                'rating' => 4.5,
                'stock' => 50,
                'status' => 1,
            ],
            [
                'name' => 'Samsung Galaxy S21',
                'slug' => 'samsung-galaxy-s21',
                'sku_code' => 'SGS21-002',
                'price' => 699.99,
                'buy_price' => 599.99,
                'discount_price' => 649.99,
                'reviews' => 120,
                'rating' => 4.3,
                'stock' => 40,
                'status' => 1,
            ],
            [
                'name' => 'Nike Air Max 270',
                'slug' => 'nike-air-max-270',
                'sku_code' => 'NAM270-003',
                'price' => 150.00,
                'buy_price' => 120.00,
                'discount_price' => 135.00,
                'reviews' => 200,
                'rating' => 4.7,
                'stock' => 100,
                'status' => 1,
            ],
            [
                'name' => 'Sony WH-1000XM4',
                'slug' => 'sony-wh-1000xm4',
                'sku_code' => 'SWH1000XM4-004',
                'price' => 349.99,
                'buy_price' => 299.99,
                'discount_price' => 319.99,
                'reviews' => 180,
                'rating' => 4.6,
                'stock' => 30,
                'status' => 1,
            ],
            [
                'name' => 'Dell XPS 13',
                'slug' => 'dell-xps-13',
                'sku_code' => 'DXPS13-005',
                'price' => 1299.99,
                'buy_price' => 1099.99,
                'discount_price' => 1199.99,
                'reviews' => 250,
                'rating' => 4.8,
                'stock' => 80,
                'status' => 1,
            ],
            [
                'name' => 'Apple Watch Series 6',
                'slug' => 'apple-watch-series-6',
                'sku_code' => 'AWS6-006',
                'price' => 349.99,
                'buy_price' => 299.99,
                'discount_price' => 319.99,
                'reviews' => 180,
                'rating' => 4.6,
                'stock' => 30,
                'status' => 1,
            ],
            [
                'name' => 'Adidas Ultraboost 21',
                'slug' => 'adidas-ultraboost-21',
                'sku_code' => 'AU21-007',
                'price' => 180.00,
                'buy_price' => 150.00,
                'discount_price' => 165.00,
                'reviews' => 160,
                'rating' => 4.4,
                'stock' => 90,
                'status' => 1,
            ],
            [
                'name' => 'HP Spectre x360',
                'slug' => 'hp-spectre-x360',
                'sku_code' => 'HPSX360-008',
                'price' => 1399.99,
                'buy_price' => 1199.99,
                'discount_price' => 1299.99,
                'reviews' => 220,
                'rating' => 4.7,
                'stock' => 70,
                'status' => 1,
            ],
            [
                'name' => 'Google Pixel 6',
                'slug' => 'google-pixel-6',
                'sku_code' => 'GP6-009',
                'price' => 599.99,
                'buy_price' => 499.99,
                'discount_price' => 549.99,
                'reviews' => 130,
                'rating' => 4.2,
                'stock' => 60,
                'status' => 1,
            ],
        ];
        foreach ($data as $product) {
            Product::updateOrCreate(
                ['name' => $product['name']],
                $product
            );
        }
    }
}

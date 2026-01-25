<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Color;
use App\Models\Size;
use App\Models\Tag;
use App\Models\Brand;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Product;
use App\Models\ProductDetails;
use App\Models\ProductInventory;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class MasterDatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Foreign key check বন্ধ রাখা হচ্ছে যেন এরর না আসে
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        // 1. Seed Colors (আপনার দেওয়া ডাটা অনুযায়ী)
        $colors = [
            ['name' => 'Red', 'hex_code' => '#FF0000'],
            ['name' => 'Green', 'hex_code' => '#00FF00'],
            ['name' => 'Blue', 'hex_code' => '#0000FF'],
            ['name' => 'Black', 'hex_code' => '#000000'],
            ['name' => 'White', 'hex_code' => '#FFFFFF'],
            ['name' => 'Yellow', 'hex_code' => '#FFFF00'],
            ['name' => 'Purple', 'hex_code' => '#800080'],
            ['name' => 'Orange', 'hex_code' => '#FFA500'],
            ['name' => 'Pink', 'hex_code' => '#FFC0CB'],
        ];
        foreach ($colors as $c) Color::updateOrCreate(['name' => $c['name']], $c);

        // 2. Seed Sizes
        $sizes = ['Small', 'Medium', 'Large', 'X-Large', 'XX-Large'];
        foreach ($sizes as $s) Size::updateOrCreate(['name' => $s]);

        // 3. Seed Tags
        $tags = ['Electronics', 'Fashion', 'New Arrival', 'Trending', 'Best Seller', 'Top Rated'];
        foreach ($tags as $t) Tag::updateOrCreate(['name' => $t]);

        // 4. Seed Brands
        $brands = ['Apple', 'Samsung', 'Nike', 'Sony', 'Adidas', 'Puma', 'Canon', 'HP'];
        foreach ($brands as $b) Brand::updateOrCreate(['name' => $b], ['slug' => Str::slug($b)]);

        // 5. 10 Categories & 4 Sub-Categories each
        $webData = [
            'Electronics' => ['Headphones', 'Smartphones', 'Laptops', 'Cameras'],
            'Women Fashion' => ['Dresses', 'Tops', 'Skirts', 'Ethnic Wear'],
            'Men Fashion' => ['Shirts', 'Jeans', 'Suits', 'T-Shirts'],
            'Bags' => ['Backpacks', 'Handbags', 'Wallets', 'Travel Bags'],
            'Shoes' => ['Sneakers', 'Formal Shoes', 'Sandals', 'Boots'],
            'Watches' => ['Smart Watches', 'Luxury Watches', 'Sports Watches', 'Casual Watches'],
            'Jewelry' => ['Earrings', 'Necklaces', 'Rings', 'Bracelets'],
            'Home & Kitchen' => ['Decor', 'Cookware', 'Furniture', 'Lighting'],
            'Beauty & Health' => ['Skincare', 'Makeup', 'Perfumes', 'Haircare'],
            'Sports & Outdoor' => ['Gym Gear', 'Camping', 'Cycling', 'Fitness Accessories'],
        ];

        foreach ($webData as $catName => $subs) {
            $category = Category::updateOrCreate(
                ['slug' => Str::slug($catName)],
                ['name' => $catName]
            );

            foreach ($subs as $subName) {
                SubCategory::updateOrCreate(
                    ['slug' => Str::slug($subName)],
                    ['name' => $subName, 'category_id' => $category->id]
                );
            }
        }

        // 6. 10 Products (Based on your website UI)
        $products = [
            [
                'name' => 'P47 Wireless Bluetooth Headphone',
                'price' => 1700,
                'sub' => 'headphones',
                'brand' => 'Sony',
                'short' => 'Vocalism Principle: Dynamic. Active Noise Cancellation: NO.'
            ],
            [
                'name' => 'Backpack With Leather Straps',
                'price' => 3200,
                'sub' => 'backpacks',
                'brand' => 'Puma',
                'short' => 'High-quality leather backpack for travel and daily use.'
            ],
            [
                'name' => 'Pink Baby Dress Soft Cotton',
                'price' => 1200,
                'sub' => 'dresses',
                'brand' => 'Adidas',
                'short' => 'Comfortable and stylish soft pink dress for babies.'
            ],
            [
                'name' => 'Men Slim Fit Formal Shirt',
                'price' => 1800,
                'sub' => 'shirts',
                'brand' => 'Nike',
                'short' => 'Premium quality slim fit cotton shirt for office wear.'
            ],
            [
                'name' => 'Luxury Golden Earrings',
                'price' => 5500,
                'sub' => 'earrings',
                'brand' => 'Samsung',
                'short' => 'Elegant golden earrings for weddings and parties.'
            ],
            [
                'name' => 'Smart Fitness Tracker Watch',
                'price' => 4500,
                'sub' => 'smart-watches',
                'brand' => 'Apple',
                'short' => 'Track your heart rate, steps, and sleep easily.'
            ],
            [
                'name' => 'Professional DSLR Camera',
                'price' => 65000,
                'sub' => 'cameras',
                'brand' => 'Canon',
                'short' => 'Capture life moments in high resolution with ease.'
            ],
            [
                'name' => 'Running Sneakers for Men',
                'price' => 4200,
                'sub' => 'sneakers',
                'brand' => 'Puma',
                'short' => 'Lightweight running shoes with maximum comfort.'
            ],
            [
                'name' => 'Cotton Printed Summer Top',
                'price' => 950,
                'sub' => 'tops',
                'brand' => 'Adidas',
                'short' => 'Cool and breathable printed top for summer days.'
            ],
            [
                'name' => 'Stainless Steel Cookware Set',
                'price' => 8500,
                'sub' => 'cookware',
                'brand' => 'HP',
                'short' => 'Durable and non-stick cookware set for modern kitchens.'
            ],
        ];

        foreach ($products as $p) {
            $subCategory = SubCategory::where('slug', $p['sub'])->first();
            $brand = Brand::where('name', $p['brand'])->first();

            if ($subCategory && $brand) {
                $product = Product::updateOrCreate(
                    ['slug' => Str::slug($p['name'])],
                    [
                        'name' => $p['name'],
                        'sku_code' => 'SKU-' . strtoupper(Str::random(6)),
                        'price' => $p['price'],
                        'buy_price' => $p['price'],
                        'discount_price' => $p['price'],
                        'stock' => rand(10, 100),
                        'status' => 1,
                    ]
                );

                // Product Details
                ProductDetails::updateOrCreate(
                    ['product_id' => $product->id],
                    [
                        'category_id' => $subCategory->category_id,
                        'sub_category_id' => $subCategory->id,
                        'brand_id' => $brand->id,
                        'short_description' => $p['short'],
                        'long_description' => 'This is a premium product of ' . $p['name'] . '. It offers great value and high-quality performance.',
                        'additional_info' => 'Warranty: 1 Year Service Warranty.',
                    ]
                );

                // Product Inventory (Size ও Color রেন্ডমলি দেওয়া হয়েছে)
                ProductInventory::updateOrCreate(
                    [
                        'product_id' => $product->id,
                        'size_id' => rand(1, 5),
                        'color_id' => rand(1, 9)
                    ],
                    ['quantity' => rand(5, 20)]
                );
            }
        }

        // Foreign key check চালু করা হচ্ছে
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
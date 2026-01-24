<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'name' => 'Electronics',
                'slug' => 'electronics',
            ],
            [
                'name' => 'Books',
                'slug' => 'books',
            ],
            [
                'name' => 'Clothing',
                'slug' => 'clothing',
            ],
            [
                'name' => 'Home & Kitchen',
                'slug' => 'home-kitchen',
            ],
            [
                'name' => 'Sports & Outdoors',
                'slug' => 'sports-outdoors',
            ],
            [
                'name' => 'Toys & Games',
                'slug' => 'toys-games',
            ],
            [
                'name' => 'Health & Personal Care',
                'slug' => 'health-personal-care',
            ],
            [
                'name' => 'Automotive',
                'slug' => 'automotive',
            ],
            [
                'name' => 'Beauty',
                'slug' => 'beauty',
            ],
        ];
        foreach ($data as $category) {
            Category::updateOrCreate(
                ['name' => $category['name']],
                $category
            );
        }
    }
}

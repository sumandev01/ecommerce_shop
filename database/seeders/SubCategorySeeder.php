<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\SubCategory;

class SubCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'name' => 'Smartphones',
                'category_id' => 1,
                'slug' => 'smartphones',
            ],
            [
                'name' => 'Laptops',
                'category_id' => 1,
                'slug' => 'laptops',
            ],
            [
                'name' => 'Fiction',
                'category_id' => 2,
                'slug' => 'fiction',
            ],
            [
                'name' => 'Non-Fiction',
                'category_id' => 2,
                'slug' => 'non-fiction',
            ],
            [
                'name' => 'Men Clothing',
                'category_id' => 3,
                'slug' => 'men-clothing',
            ],
            [
                'name' => 'Women Clothing',
                'category_id' => 3,
                'slug' => 'women-clothing',
            ],
            [
                'name' => 'Home & Kitchen',
                'category_id' => 4,
                'slug' => 'home-kitchen',
            ],
            [
                'name' => 'Sports & Outdoors',
                'category_id' => 5,
                'slug' => 'sports-outdoors',
            ],
            [
                'name' => 'Toys & Games',
                'category_id' => 6,
                'slug' => 'toys-games',
            ],
            [
                'name' => 'Books',
                'category_id' => 7,
                'slug' => 'books',
            ],
        ];

        foreach ($data as $subCategory) {
            // Check if a record with the same name already exists
            $existing = SubCategory::where('name', $subCategory['name'])->first();

            if ($existing) {
                // If exists, update the existing record
                $existing->update($subCategory);
            } else {
                // If doesn't exist, find the first missing ID starting from 1
                $newId = 1;
                while (SubCategory::where('id', $newId)->exists()) {
                    $newId++;
                }

                // Create a new record with the missing ID
                $newData = array_merge($subCategory, ['id' => $newId]);
                SubCategory::create($newData);
            }
        }
    }
}
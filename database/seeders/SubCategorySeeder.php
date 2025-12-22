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
        SubCategory::query()->delete();
        $data = [
            ['id' => 1, 'category_id' => 1, 'name' => 'Electronics', 'slug' => 'electronics', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 2, 'category_id' => 1, 'name' => 'Smartphones', 'slug' => 'smartphones', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 3, 'category_id' => 1, 'name' => 'Laptops', 'slug' => 'laptops', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 4, 'category_id' => 1, 'name' => 'Tablets', 'slug' => 'tablets', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 5, 'category_id' => 2, 'name' => 'Clothing', 'slug' => 'clothing', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 6, 'category_id' => 2, 'name' => 'Shoes', 'slug' => 'shoes', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 7, 'category_id' => 2, 'name' => 'Accessories', 'slug' => 'accessories', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 8, 'category_id' => 3, 'name' => 'Home Appliances', 'slug' => 'home-appliances', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 9, 'category_id' => 3, 'name' => 'Kitchenware', 'slug' => 'kitchenware', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 10, 'category_id' => 3, 'name' => 'Cleaning Supplies', 'slug' => 'cleaning-supplies', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 11, 'category_id' => 4, 'name' => 'Books', 'slug' => 'books', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 12, 'category_id' => 4, 'name' => 'Novels', 'slug' => 'novels', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 13, 'category_id' => 4, 'name' => 'Magazines', 'slug' => 'magazines', 'created_at' => now(), 'updated_at' => now()],
        ];
        SubCategory::insert($data);
    }
}

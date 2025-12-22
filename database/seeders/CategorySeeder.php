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
        Category::query()->delete();
        $data = [
            [
                'id' => 1,
                'name' => 'Electronics',
                'slug' => 'electronics',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 2,
                'name' => 'Books',
                'slug' => 'books',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 3,
                'name' => 'Clothing',
                'slug' => 'clothing',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 4,
                'name' => 'Home & Kitchen',
                'slug' => 'home-kitchen',
                'created_at' => now(),
                'updated_at' => now()
            ],
        ];
        Category::insert($data);
    }
}

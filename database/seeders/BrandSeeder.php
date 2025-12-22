<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Brand;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Brand::query()->delete();
        $data = [
            [
                'id' => 1,
                'name' => 'Apple',
                'slug' => 'apple',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 2,
                'name' => 'Samsung',
                'slug' => 'samsung',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 3,
                'name' => 'Nike',
                'slug' => 'nike',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 4,
                'name' => 'Sony',
                'slug' => 'sony',
                'created_at' => now(),
                'updated_at' => now()
            ],
        ];
        Brand::insert($data);
    }
}

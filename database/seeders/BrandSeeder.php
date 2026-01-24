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
        $data = [
            [
                'name' => 'Apple',
                'slug' => 'apple',
            ],
            [
                'name' => 'Samsung',
                'slug' => 'samsung',
            ],
            [
                'name' => 'Nike',
                'slug' => 'nike',
            ],
            [
                'name' => 'Sony',
                'slug' => 'sony',
            ],
            [
                'name' => 'Adidas',
                'slug' => 'adidas',
            ],
            [
                'name' => 'Puma',
                'slug' => 'puma',
            ],
            [
                'name' => 'Under Armour',
                'slug' => 'under-armour',
            ],
            [
                'name' => 'Asics',
                'slug' => 'asics',
            ],
            [
                'name' => 'Reebok',
                'slug' => 'reebok',
            ],
            [
                'name' => 'New Balance',
                'slug' => 'new-balance',
            ],
        ];
        foreach ($data as $brand) {
            Brand::updateOrCreate(
                ['name' => $brand['name']],
                $brand
            );
        }
    }
}

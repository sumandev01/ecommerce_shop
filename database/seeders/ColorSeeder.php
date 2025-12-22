<?php

namespace Database\Seeders;

use App\Models\Color;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;


class ColorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Color::query()->delete();
        $data = [
            [
                'id' => 1,
                'name' => 'Red',
                'hex_code' => '#FF0000',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 2,
                'name' => 'Green',
                'hex_code' => '#00FF00',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 3,
                'name' => 'Blue',
                'hex_code' => '#0000FF',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 4,
                'name' => 'Black',
                'hex_code' => '#000000',
                'created_at' => now(),
                'updated_at' => now()
            ],
        ];
        Color::insert($data);
    }
}

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
        $data = [
            [
                'name' => 'Red',
                'hex_code' => '#FF0000',
            ],
            [
                'name' => 'Green',
                'hex_code' => '#00FF00',
            ],
            [
                'name' => 'Blue',
                'hex_code' => '#0000FF',
            ],
            [
                'name' => 'Black',
                'hex_code' => '#000000',
            ],
            [
                'name' => 'White',
                'hex_code' => '#FFFFFF',
            ],
            [
                'name' => 'Yellow',
                'hex_code' => '#FFFF00',
            ],
            [
                'name' => 'Purple',
                'hex_code' => '#800080',
            ],
            [
                'name' => 'Orange',
                'hex_code' => '#FFA500',
            ],
            [
                'name' => 'Pink',
                'hex_code' => '#FFC0CB',
            ],
        ];
        foreach ($data as $color) {
            Color::updateOrCreate(
                ['name' => $color['name']],
                $color
            );
        }
    }
}

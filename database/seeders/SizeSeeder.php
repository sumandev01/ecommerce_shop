<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Size;

class SizeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['name' => 'Small',],
            ['name' => 'Medium',],
            ['name' => 'Large',],
            ['name' => 'X-Large',],
            ['name' => 'XX-Large',],
        ];
        foreach ($data as $size) {
            Size::updateOrCreate(
                ['name' => $size['name']],
                $size
            );
        }
    }
}

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
        Size::query()->delete();
        $data = [
            ['id' => 1, 'name' => 'Small', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 2, 'name' => 'Medium', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 3, 'name' => 'Large', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 4, 'name' => 'X-Large', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 5, 'name' => 'XX-Large', 'created_at' => now(), 'updated_at' => now()],
        ];
        Size::insert($data);
    }
}

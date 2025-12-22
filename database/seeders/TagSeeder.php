<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Tag;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Tag::query()->delete();
        $data = [
            ['id' => 1, 'name' => 'Electronics', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 2, 'name' => 'Fashion', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 3, 'name' => 'Home Appliances', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 4, 'name' => 'Books', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 5, 'name' => 'Sports', 'created_at' => now(), 'updated_at' => now()],
        ];
        Tag::insert($data);
    }
}

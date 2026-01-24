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
        $data = [
            ['name' => 'Electronics'],
            ['name' => 'Fashion'],
            ['name' => 'Home Appliances'],
            ['name' => 'Books'],
            ['name' => 'Sports'],
            ['name' => 'Home Appliances'],
            ['name' => 'Books'],
            ['name' => 'Sports'],
        ];
        foreach ($data as $tag) {
            Tag::updateOrCreate(
                ['name' => $tag['name']],
                $tag
            );
        }
    }
}

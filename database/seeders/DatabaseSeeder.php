<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\BrandSeeder;
use Database\Seeders\ProductSeeder;
use Database\Seeders\CategorySeeder;
use Database\Seeders\TagSeeder;
use Database\Seeders\SizeSeeder;
use Database\Seeders\ColorSeeder;
use Database\Seeders\SubCategorySeeder;
use Database\Seeders\ProductDetailsSeeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            BrandSeeder::class,
            ProductSeeder::class,
            CategorySeeder::class,
            TagSeeder::class,
            SizeSeeder::class,
            ColorSeeder::class,
            SubCategorySeeder::class,
            ProductDetailsSeeder::class,
        ]);
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
    }
}

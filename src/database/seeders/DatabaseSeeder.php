<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Models\User::factory(10)->create();
        Models\Brand::factory(10)->create();
        Models\Category::factory(10)->create();
        Models\Product::factory(10)->create();
        Models\Coupon::factory()
            ->has(Models\Product::factory()->count(5))
            ->count(10)
            ->create();
    }
}

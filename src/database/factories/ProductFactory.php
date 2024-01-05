<?php

namespace Database\Factories;

use App\Models;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = fake()->userName;
        return [
            'category_id' => Models\Category::factory(),
            'brand_id' => Models\Brand::factory(),
            'name' => $name,
            'content' => fake()->realText,
            'slug' => Str::slug($name),
            'price' => rand(1000, 2000)
        ];
    }
}

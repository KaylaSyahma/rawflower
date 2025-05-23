<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ProductFactory extends Factory
{
    public function definition(): array
    {
        return [
            'category_id'    => Category::factory(), // bikin kategori otomatis
            'name'           => $this->faker->words(3, true),
            'slug'           => Str::slug($this->faker->unique()->words(3, true)),
            'description'    => $this->faker->paragraph(),
            'original_price' => $this->faker->randomFloat(2, 10000, 200000),
            'quantity'       => $this->faker->numberBetween(1, 100),
            'popular'        => $this->faker->boolean(30), // 30% chance true
            'status'         => $this->faker->boolean(90), // 90% chance true
        ];
    }
}

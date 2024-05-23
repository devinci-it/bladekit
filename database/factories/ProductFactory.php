<?php

namespace Database\Factories;

use Devinci\Bladekit\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    protected $model = Product::class;

    public function definition()
    {
        return [
            'name' => $this->faker->unique()->word,
            'description' => $this->faker->sentence,
            'price' => $this->faker->randomFloat(2, 10, 1000),
            'quantity' => $this->faker->numberBetween(0, 100),
            'category' => $this->faker->randomElement(['Electronics', 'Clothing', 'Books', 'Home Decor']),
            'active' => $this->faker->boolean(90), // 90% chance of being active
        ];
    }
}

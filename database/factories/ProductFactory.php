<?php

namespace Database\Factories;

use App\Models\Seller;
use Illuminate\Database\Eloquent\Factories\Factory;

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
        return [
            'phone_name' => rand(1000000000, 9999999999),
            'display_size' => $this->faker->numberBetween(0, 30),
            'quantity' => $this->faker->randomNumber(2),
            'cost' => $this->faker->randomFloat(2, 1, 100)
        ];
    }
}

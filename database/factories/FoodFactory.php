<?php

namespace Database\Factories;

use App\Models\Restaurant;
use Illuminate\Database\Eloquent\Factories\Factory;
use function Ybazli\Faker\randomNumber;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Food>
 */
class FoodFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'restaurant_id' => Restaurant::query()->inRandomOrder()->first(),
            'name' => 'غذای ' . rand(1, 10000),
            'ingredient' => fake()->realText(),
            'price' => rand(1000, 500000),
        ];
    }
}

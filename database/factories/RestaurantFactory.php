<?php

namespace Database\Factories;

use App\Models\RestaurantCategory;
use App\Models\Seller;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Restaurant>
 */
class RestaurantFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'restaurant_category_id' => RestaurantCategory::query()->inRandomOrder()->take(1)->first(),
            'seller_id' => Seller::factory()->create(),
            'name' => fake()->company(),
            'address' => fake()->address(),
            'latitude' => fake()->latitude(25, 40),
            'longitude' => fake()->longitude(43, 62),
            'phone' => fake()->phoneNumber(),
            'bank_account_number' => fake()->numberBetween(100000000, 99999999999999)
        ];
    }
}

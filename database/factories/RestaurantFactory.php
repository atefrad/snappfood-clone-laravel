<?php

namespace Database\Factories;

use App\Models\RestaurantCategory;
use App\Models\Seller;
use Illuminate\Database\Eloquent\Factories\Factory;
use Ybazli\Faker\Facades\Faker;

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
            'seller_id' => Seller::query()->inRandomOrder()->take(1)->first(),
            'name' => Faker::word(),
            'address' => [
                'state' => Faker::state(),
                'city' => Faker::city(),
                'address' => Faker::address()
            ],
            'phone' => Faker::mobile(),
            'bank_account_number' => fake()->numberBetween(100000000, 99999999999999)
        ];
    }
}

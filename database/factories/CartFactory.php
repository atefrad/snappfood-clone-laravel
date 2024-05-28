<?php

namespace Database\Factories;

use App\Models\Customer;
use App\Models\Restaurant;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Cart>
 */
class CartFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'customer_id' => Customer::query()->inRandomOrder()->take(1)->first(),
            'restaurant_id' => Restaurant::query()->inRandomOrder()->take(1)->first(),
        ];
    }
}

<?php

namespace Database\Factories;

use App\Models\Cart;
use App\Models\Food;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CartItem>
 */
class CartItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'cart_id' => Cart::query()->inRandomOrder()->take(1)->first(),
            'food_id' => Food::query()->inRandomOrder()->take(1)->first(),
            'count' => rand(1, 5),
        ];
    }
}

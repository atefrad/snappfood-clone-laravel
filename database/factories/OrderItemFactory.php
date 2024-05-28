<?php

namespace Database\Factories;

use App\Models\Food;
use App\Models\Order;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\OrderItem>
 */
class OrderItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        /** @var Food $food */
        $food = Food::query()->inRandomOrder()->take(1)->first();
        $count = rand(1, 5);
        $discount = $food->activeDiscount;
        $foodParty =  $food->activeFoodParty;

        return [
            'order_id' => Order::query()->inRandomOrder()->take(1)->first(),
            'food_id' => $food,
            'count' => $count,
            'discount_id' => $discount ? $discount->id : null,
            'discount_percentage' => $discount ? $discount->percentage : 0,
            'food_party_id' => $foodParty ? $foodParty->id : null,
            'food_party_percentage' => $foodParty ? $foodParty->percentage : 0,
            'final_food_price' => $food->priceAfterDiscount,
            'final_total_price' => $food->priceAfterDiscount * $count,
        ];
    }
}

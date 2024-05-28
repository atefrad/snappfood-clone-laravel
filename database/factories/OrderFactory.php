<?php

namespace Database\Factories;

use App\Models\Cart;
use App\Models\Customer;
use App\Models\Payment;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        /** @var Cart $cart */
        $cart = Cart::factory()->create([
            'finished_at' => now()
        ]);

        return [
            'cart_id' => $cart,
            'customer_id' => $cart->customer_id,
            'restaurant_id' => $cart->restaurant_id,
            'address_id' => $cart->customer->currentAddress->id,
            'payment_id' => Payment::factory()->create([
                'cart_id' => $cart->id
            ]),
            'order_status_id' => rand(1,4)
        ];
    }
}

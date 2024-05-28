<?php

namespace Database\Factories;

use App\Models\Cart;
use App\Models\Customer;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Payment>
 */
class PaymentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        /** @var Cart $cart */
        $cart = Cart::query()->inRandomOrder()->take(1)->first();

        return [
            'customer_id' => Customer::query()->inRandomOrder()->take(1)->first(),
            'cart_id' => $cart,
            'amount' => $cart->totalPrice,
            'pay_date' => now()
        ];
    }
}

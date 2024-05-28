<?php

namespace Database\Seeders;

use App\Models\Cart;
use App\Models\CartItem;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CartItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $carts = Cart::all();

        foreach ($carts as $cart)
        {
            CartItem::factory(rand(1,5))->create([
                'cart_id' => $cart->id
            ]);
        }
    }
}

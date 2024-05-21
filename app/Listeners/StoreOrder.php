<?php

namespace App\Listeners;

use App\Events\CartPayed;
use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\OrderStatus;
use Illuminate\Support\Facades\Auth;

class StoreOrder
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(CartPayed $event): void
    {
        /** @var Customer $customer */
        $customer = Auth::guard('customer')->user();

        /** @var Order $order */
        $order = Order::query()->create([
            'cart_id' => $event->cart->id,
            'customer_id' => $customer->id,
            'restaurant_id' => $event->cart->restaurant_id,
            'address_id' => $customer->currentAddress->id,
            'payment_id' => $event->payment->id,
            'order_status_id' => OrderStatus::UNDER_REVIEW,
        ]);

        foreach ($event->cart->cartItems as $cartItem)
        {
            $count = $cartItem->count;
            $priceAfterDiscount = $cartItem->food->priceAfterDiscount;
            $discount = $cartItem->food->activeDiscount;
            $foodParty = $cartItem->food->activeFoodParty;

            OrderItem::query()->create([
                'order_id' => $order->id,
                'food_id' => $cartItem->food_id,
                'count' => $count,
                'discount_id' => $discount ? $discount->id : null,
                'discount_percentage' => $discount ? $discount->percentage : 0,
                'food_party_id' => $foodParty ? $foodParty->id: null,
                'food_party_percentage' => $foodParty ? $foodParty->percentage: 0,
                'final_food_price' => $priceAfterDiscount,
                'final_total_price' => $priceAfterDiscount * $count,
            ]);
        }
    }
}

<?php

namespace App\Http\Resources\V1\Customer\Cart;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CartResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $cart = $this->resource;

        return [
            'id' => $cart->id,
            'restaurant' => RestaurantResource::make($cart->restaurant),
            'foods' => FoodResource::collection($cart->foods),
            'totalFoodPrice' => $cart->totalFoodPrice,
            'deliveryPrice' => $cart->restaurant->delivery_price ?? 0,
            'totalPrice' => $cart->totalPrice
        ];
    }
}

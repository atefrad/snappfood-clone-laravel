<?php

namespace App\Http\Resources\V1\Customer\Cart;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CartCollectionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $cart = $this->resource;

        $foods = $cart->foods()
            ->wherePivotNull('deleted_at')
            ->get();

        return [
            'id' => $cart->id,
            'restaurant' => RestaurantResource::make($cart->restaurant),
            'foods' => FoodResource::collection($foods)
        ];
    }
}

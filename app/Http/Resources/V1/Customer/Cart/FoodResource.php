<?php

namespace App\Http\Resources\V1\Customer\Cart;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FoodResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $food = $this->resource;

        return [
            'id' => $food->id,
            'name' => $food->name,
            'count' =>$food->pivot->count,
            'price' => $food->price,
            'priceAfterDiscount' => $food->priceAfterDiscount,
            'totalFoodPrice' => $food->priceAfterDiscount * $food->pivot->count
        ];
    }
}

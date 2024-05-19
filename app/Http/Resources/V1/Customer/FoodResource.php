<?php

namespace App\Http\Resources\V1\Customer;

use App\Models\Food;
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
            'price' => $food->price,
            'priceAfterDiscount' => $food->priceAfterDiscount,
            'activeDiscount' => $this->checkActiveDiscount($food),
            'ingredient' => $food->ingredient,
            'image' => $food->image ? asset($food->image) : null
        ];
    }

    public function checkActiveDiscount(Food $food): ?string
    {
        if($food->activeDiscount)
        {
            return $food->activeDiscount->percentage . '%';
        }
        return null;
    }
}

<?php

namespace App\Http\Resources\V1\Customer;

use App\Http\Resources\V1\Customer\Restaurant\RestaurantCollectionResource;
use App\Http\Resources\V1\Customer\Restaurant\RestaurantResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FoodSearchResource extends JsonResource
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
            'ingredient' => $food->ingredient,
            'image' => $food->image ? asset($food->image) : null,
            'restaurant' => RestaurantCollectionResource::make($food->restaurant),
        ];
    }
}

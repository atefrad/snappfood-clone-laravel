<?php

namespace App\Http\Resources\V1\Customer\Restaurant;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RestaurantCollectionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $restaurant = $this->resource;

        return [
            'id' => $restaurant->id,
            'name' => $restaurant->name,
            'type' => $restaurant->restaurantCategory->name,
            'address' => [
                'address' => $restaurant->address['address'],
                'latitude' => $restaurant->address['latitude'],
                'longitude' => $restaurant->address['longitude'],
            ],
            'is_open' => (bool)$restaurant->realIsOpen,
            'image' => $restaurant->image ? asset($restaurant->image): null
        ];
    }
}

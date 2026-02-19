<?php

namespace App\Http\Resources\V1\Customer\Restaurant;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Resource for representing restaurants in customer listing views.
 *
 * Returns a lightweight representation including location,
 * availability status, image url, and average score.
 */
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
                'address' => $restaurant->address,
                'latitude' => $restaurant->latitude,
                'longitude' => $restaurant->longitude,
            ],
            // Derived open status considering working time.
            'is_open' => (bool)$restaurant->realIsOpen,
            'image' => $restaurant->image ? asset($restaurant->image): null,
            'score' => $restaurant->formattedScore,
        ];
    }
}

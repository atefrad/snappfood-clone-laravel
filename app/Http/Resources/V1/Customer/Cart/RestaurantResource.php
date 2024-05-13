<?php

namespace App\Http\Resources\V1\Customer\Cart;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RestaurantResource extends JsonResource
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
            'name' => $restaurant->name,
            'image' => asset($restaurant->image)
        ];
    }
}

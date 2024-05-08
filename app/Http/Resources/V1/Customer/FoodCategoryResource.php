<?php

namespace App\Http\Resources\V1\Customer;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FoodCategoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $foodCategory = $this->resource;

        $foods = $foodCategory->foods()->where('restaurant_id', $request->route('restaurant')->id)->get();

        return [
            'id' => $foodCategory->id,
            'name' => $foodCategory->name,
            'foods' => FoodResource::collection($foods),
        ];
    }
}

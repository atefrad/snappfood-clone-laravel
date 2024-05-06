<?php

namespace App\Http\Resources\V1\Customer;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AddressResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $address = $this->resource;

        return [
            'id' => $address->id,
            'title' => $address->title,
            'address' => $address->address,
            'latitude' => $address->latitude,
            'longitude' => $address->longitude,
        ];
    }
}

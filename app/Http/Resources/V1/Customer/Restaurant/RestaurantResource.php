<?php

namespace App\Http\Resources\V1\Customer\Restaurant;

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
            'id' => $restaurant->id,
            'name' => $restaurant->name,
            'type' => $restaurant->restaurantCategory->name,
            'address' => [
                'address' => $restaurant->address,
                'latitude' => $restaurant->latitude,
                'longitude' => $restaurant->longitude,
            ],
            'is_open' => (bool)$restaurant->realIsOpen,
            'image' => $restaurant->image ? asset($restaurant->image): null,
            'score' => $restaurant->score !== null ? round($restaurant->score, 2) : null,
            'comments_count' => $restaurant->commentsCount,
            'schedule' => [
                'saturday' => $this->checkSchedule(6),
                'sunday' => $this->checkSchedule(0),
                'monday' => $this->checkSchedule(1),
                'tuesday' => $this->checkSchedule(2),
                'wednesday' => $this->checkSchedule(3),
                'thursday' => $this->checkSchedule(4),
                'friday' => $this->checkSchedule(5),
            ],
        ];
    }

    public function checkSchedule(int $dayInWeek): ?array
    {
        $restaurant = $this->resource;

        $dayInWeek = str($dayInWeek);

        if($restaurant->restaurantWorkingTime && in_array($dayInWeek, $restaurant->restaurantWorkingTime->working_days))
        {
            return [
                'start' => substr($restaurant->restaurantWorkingTime->opening_time, 0,5),
                'end' => substr($restaurant->restaurantWorkingTime->closing_time, 0,5)
            ];
        }
        return null;
    }
}

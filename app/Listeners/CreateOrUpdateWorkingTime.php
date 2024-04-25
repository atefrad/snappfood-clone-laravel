<?php

namespace App\Listeners;

use App\Events\RestaurantUpdated;
use App\Models\RestaurantWorkingTime;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class CreateOrUpdateWorkingTime
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(RestaurantUpdated $event): void
    {
        if($event->restaurant->restaurantWorkingTime)
        {
            $event->restaurant->restaurantWorkingTime()
                ->update([
                    'working_days' => request('working_days'),
                    'opening_time' => request('opening_time'),
                    'closing_time' => request('closing_time')
                ]);
        }
        else
        {
            RestaurantWorkingTime::query()
                ->create([
                    'restaurant_id'=> $event->restaurant->id,
                    'working_days' => request('working_days'),
                    'opening_time' => request('opening_time'),
                    'closing_time' => request('closing_time')
                ]);
        }
    }
}

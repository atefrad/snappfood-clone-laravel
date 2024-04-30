<?php

namespace App\Listeners;

use App\Events\RestaurantUpdated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class AddOrUpdateRestaurantFoodCategories
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
        if($event->restaurant->foodCategories)
        {
            if($event->restaurant->foodCategories->pluck('id')->toArray() != request('food_category_id'))
            {
                $event->restaurant->foodCategories()->detach();

                $event->restaurant->foodCategories()->attach(request('food_category_id'));
            }
        }
        else{
            $event->restaurant->foodCategories()->attach(request('food_category_id'));
        }
    }
}

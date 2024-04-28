<?php

namespace App\Listeners;

use App\Events\FoodUpdated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class UpdateFoodFoodCategories
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
    public function handle(FoodUpdated $event): void
    {
        if($event->food->foodCategories->pluck('id')->toArray() != request('food_category_id'))
        {
            $event->food->foodCategories()->detach();

            $event->food->foodCategories()->attach(request('food_category_id'));
        }
    }
}

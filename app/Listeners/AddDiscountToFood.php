<?php

namespace App\Listeners;

use App\Events\FoodUpdated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class AddDiscountToFood
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
    public function handle(FoodUpdated $event)
    {
        if(!empty(request('discount')))
        {
            if($event->food->activeDiscount)
            {
                return redirect()->route('seller.food.edit', $event->food)
                    ->with('toast-error', __('response.food_discount_error'));
            }

            $event->food->discounts()->attach(request('discount'));
        }
    }
}

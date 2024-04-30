<?php

namespace App\Providers;

use App\Events\FoodUpdated;
use App\Events\RestaurantUpdated;
use App\Listeners\AddDiscountToFood;
use App\Listeners\AddOrUpdateRestaurantFoodCategories;
use App\Listeners\CreateOrUpdateWorkingTime;
use App\Listeners\UpdateFoodFoodCategories;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        RestaurantUpdated::class => [
            CreateOrUpdateWorkingTime::class,
            AddOrUpdateRestaurantFoodCategories::class,
        ],
        FoodUpdated::class => [
            AddDiscountToFood::class,
            UpdateFoodFoodCategories::class,
        ],
    ];

    /**
     * Register any events for your application.
     */
    public function boot(): void
    {
        //
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     */
    public function shouldDiscoverEvents(): bool
    {
        return false;
    }
}

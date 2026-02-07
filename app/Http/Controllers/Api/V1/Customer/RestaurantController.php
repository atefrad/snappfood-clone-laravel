<?php

namespace App\Http\Controllers\Api\V1\Customer;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\Customer\Restaurant\RestaurantCollectionResource;
use App\Http\Resources\V1\Customer\Restaurant\RestaurantResource;
use App\Models\Restaurant;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class RestaurantController extends Controller
{
    /**
     * Return a paginated list of restaurants for customers.
     *
     * Results can be filtered by category, open status (based on working time),
     * and minimum average score. Response is optimized for listing views.
     */
    public function index(): AnonymousResourceCollection
    {
        $restaurants = Restaurant::query()
            ->filterRestaurantCategory()
            ->filterIsOpen()
            ->filterScore()
            ->with(['restaurantCategory', 'restaurantWorkingTime'])
            ->paginate(Controller::DEFAULT_PAGINATE);

        return RestaurantCollectionResource::collection($restaurants);
    }

    public function show(Restaurant $restaurant): RestaurantResource
    {
        return RestaurantResource::make($restaurant);
    }
}

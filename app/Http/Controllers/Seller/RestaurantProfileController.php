<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Http\Requests\Seller\StoreRestaurantProfileRequest;
use App\Models\Restaurant;
use App\Models\RestaurantCategory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RestaurantProfileController extends Controller
{
    public function create(): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        $restaurantCategories = RestaurantCategory::all();

        return view('seller.restaurant-profile', compact('restaurantCategories'));
    }

    public function store(StoreRestaurantProfileRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        Restaurant::query()->create($validated);

        return redirect()->route('seller.dashboard.orders.new-orders');
    }
}

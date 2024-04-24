<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Http\Requests\Seller\StoreRestaurantRequest;
use App\Models\Restaurant;
use App\Models\RestaurantCategory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class RestaurantController extends Controller
{
    public function create(): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        $restaurantCategories = RestaurantCategory::all();

        return view('seller.setting.create', compact('restaurantCategories'));
    }

    public function store(StoreRestaurantRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        Restaurant::query()->create($validated);

        return redirect()->route('seller.restaurant.show');
    }

    public function show(Restaurant $restaurant): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('seller.setting.show', compact('restaurant'));
    }

    public function changeStatus()
    {

    }
}

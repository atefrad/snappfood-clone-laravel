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

        $restaurant = Restaurant::query()->create($validated);

        return redirect()->route('seller.restaurant.show', $restaurant);
    }

    public function show(Restaurant $restaurant): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('seller.setting.show', compact('restaurant'));
    }

    public function changeStatus()
    {

    }

    public function edit(Restaurant $restaurant): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        $restaurantCategories = RestaurantCategory::all();

        return view('seller.setting.edit', compact('restaurantCategories', 'restaurant'));
    }

    public function update(Request $request, Restaurant $restaurant)
    {
        dd($request->all());
    }
}

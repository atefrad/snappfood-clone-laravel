<?php

namespace App\Http\Controllers\Seller;

use App\Events\RestaurantUpdated;
use App\Http\Controllers\Controller;
use App\Http\Requests\Seller\Restaurant\StoreRestaurantRequest;
use App\Http\Requests\Seller\Restaurant\UpdateRestaurantRequest;
use App\Models\Restaurant;
use App\Models\RestaurantCategory;
use App\Models\RestaurantWorkingTime;
use App\Services\ImageRealPath;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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

        return redirect()->route('seller.restaurant.show', $restaurant)
            ->with('toast-success', __('response.restaurant_store_success'));
    }

    /**
     * @throws AuthorizationException
     */
    public function show(Restaurant $restaurant): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        $this->authorize('view', $restaurant);

        return view('seller.setting.show', compact('restaurant'));
    }

    public function changeStatus(Restaurant $restaurant): RedirectResponse
    {
        $is_open = $restaurant->is_open ? 0 : 1;

        $restaurant->update([
            'is_open' => $is_open
        ]);

        return redirect()->route('seller.restaurant.show', $restaurant)
            ->with('toast-success', __('response.restaurant_change_status_success'));
    }

    /**
     * @throws AuthorizationException
     */
    public function edit(Restaurant $restaurant): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        $this->authorize('update', $restaurant);

        $restaurantCategories = RestaurantCategory::all();

        return view('seller.setting.edit', compact('restaurantCategories', 'restaurant'));
    }

    /**
     * @throws AuthorizationException
     */
    public function update(UpdateRestaurantRequest $request, Restaurant $restaurant): RedirectResponse
    {
        $this->authorize('update', $restaurant);

        /** @var Restaurant $restaurant */

        $validated = $request->validated();

        if ($request->hasFile('image'))
        {
            if($restaurant->image)
            {
                $oldImagePath = ImageRealPath::getImageRealPath($restaurant->image);

                Storage::disk('public')->delete($oldImagePath);
            }

            $imagePath = $request
                ->file('image')
                ->store('/images/restaurant', 'public');

            $validated['image'] = "/storage/{$imagePath}";
        }

        $restaurant->update($validated);

        //event listener for creat or updating working_time table
        RestaurantUpdated::dispatch($restaurant);

        return redirect()->route('seller.restaurant.show', $restaurant)
            ->with('toast-success', __('response.restaurant_update_success'));
    }
}

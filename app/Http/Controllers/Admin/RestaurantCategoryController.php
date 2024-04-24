<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\RestaurantCategory\StoreRestaurantCategoryRequest;
use App\Http\Requests\Admin\RestaurantCategory\UpdateRestaurantCategoryRequest;
use App\Models\RestaurantCategory;
use App\Services\ImageRealPath;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class RestaurantCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        $restaurantCategories = RestaurantCategory::all();

        return view('admin.restaurant-category.index', compact('restaurantCategories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('admin.restaurant-category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRestaurantCategoryRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        if ($request->hasFile('image'))
        {
            $imagePath = $request
                ->file('image')
                ->store('/images/restaurant-category', 'public');

            $validated['image'] = "/storage/{$imagePath}";
        }

        $restaurantCategory = RestaurantCategory::query()->create($validated);

        return redirect()->route('admin.restaurant-category.index')
            ->with('toast-success', __('response.category_store_success'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(RestaurantCategory $restaurantCategory): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('admin.restaurant-category.edit', compact('restaurantCategory'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRestaurantCategoryRequest $request, RestaurantCategory $restaurantCategory): RedirectResponse
    {
        $validated = $request->validated();

        if ($request->hasFile('image'))
        {
            if($restaurantCategory->image)
            {
                $oldImagePath = ImageRealPath::getImageRealPath($restaurantCategory->image);

                Storage::disk('public')->delete($oldImagePath);
            }

            $imagePath = $request
                ->file('image')
                ->store('/images/restaurant-category', 'public');

            $validated['image'] = "/storage/{$imagePath}";
        }

        $restaurantCategory->update($validated);

        return redirect()->route('admin.restaurant-category.index')
            ->with('toast-success', __('response.category_update_success'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(RestaurantCategory $restaurantCategory): RedirectResponse
    {
        $restaurantCategory->delete();

        return redirect()->route('admin.restaurant-category.index')
            ->with('toast-success', __('response.category_delete_success'));
    }
}

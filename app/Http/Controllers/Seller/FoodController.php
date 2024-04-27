<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Http\Requests\Seller\Food\StoreFoodRequest;
use App\Http\Requests\Seller\Food\UpdateFoodRequest;
use App\Models\Food;
use App\Models\FoodCategory;
use App\Services\ImageRealPath;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FoodController extends Controller
{
    public function index(): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        $restaurantId = auth('seller')->user()->restaurant->id;

        $foods = Food::query()
            ->where('restaurant_id', $restaurantId)
            ->filterName()
            ->filterCategory()
            ->paginate(Controller::DEFAULT_PAGINATE);

        $foodCategories = FoodCategory::all();

        return view('seller.food.index', compact('foods', 'foodCategories'));
    }

    public function create(): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        $foodCategories = FoodCategory::all();

        return view('seller.food.create', compact( 'foodCategories'));
    }

    public function store(StoreFoodRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        if ($request->hasFile('image'))
        {
            $imagePath = $request
                ->file('image')
                ->store('/images/food', 'public');

            $validated['image'] =  "/storage/{$imagePath}";
        }

        /** @var Food $food */

        $food = Food::query()->create($validated);

        $food->foodCategories()->attach($validated['food_category_id']);

        return redirect()->route('seller.food.index')
            ->with('toast-success', __('response.food_store_success'));
    }

    public function edit(Food $food): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        $foodCategories = FoodCategory::all();

        return view('seller.food.edit', compact( 'food','foodCategories'));
    }

    public function update(UpdateFoodRequest $request, Food $food)
    {
        $validated = $request->validated();

        if ($request->hasFile('image'))
        {
            if($food->image)
            {
                $oldImagePath = ImageRealPath::getImageRealPath($food->image);

                Storage::disk('public')->delete($oldImagePath);
            }

            $imagePath = $request
                ->file('image')
                ->store('/images/food', 'public');

            $validated['image'] =  "/storage/{$imagePath}";
        }

        if($food->foodCategories->pluck('id')->toArray() != $validated['food_category_id'])
        {
            $food->foodCategories()->detach();

            $food->foodCategories()->attach($validated['food_category_id']);
        }

        $food->update($validated);

        return redirect()->route('seller.food.index')
            ->with('toast-success', __('response.food_update_success'));
    }
}

<?php

namespace App\Http\Controllers\Seller;

use App\Events\FoodUpdated;
use App\Http\Controllers\Controller;
use App\Http\Requests\Seller\Food\StoreFoodRequest;
use App\Http\Requests\Seller\Food\UpdateFoodRequest;
use App\Models\Discount;
use App\Models\Food;
use App\Models\FoodCategory;
use App\Models\Seller;
use App\Services\ImageRealPath;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        /** @var Seller $seller */

        $seller = Auth::guard('seller')->user();

        $foodCategories = $seller->restaurant->foodCategories;

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

    /**
     * @throws AuthorizationException
     */
    public function edit(Food $food): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        $this->authorize('update', $food);

        /** @var Seller $seller */

        $seller = Auth::guard('seller')->user();

        $foodCategories = $seller->restaurant->foodCategories;

        $discounts = Discount::query()->active()->get();

        dd($discounts);

        return view('seller.food.edit', compact( 'food','foodCategories', 'discounts'));
    }

    /**
     * @throws AuthorizationException
     */
    public function update(UpdateFoodRequest $request, Food $food): RedirectResponse
    {
        $this->authorize('update', $food);

        $validated = $request->validated();

        //dispatching the event
        FoodUpdated::dispatch($food);

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

        $food->update($validated);

        return redirect()->route('seller.food.index')
            ->with('toast-success', __('response.food_update_success'));
    }

    /**
     * @throws AuthorizationException
     */
    public function destroy(Food $food): RedirectResponse
    {
        $this->authorize('delete', $food);

        $food->delete();

        return redirect()->route('seller.food.index')
            ->with('toast-success', __('response.food_delete_success'));

    }
}

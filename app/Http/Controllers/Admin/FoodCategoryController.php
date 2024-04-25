<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\FoodCategory\StoreFoodCategoryRequest;
use App\Http\Requests\Admin\FoodCategory\UpdateFoodCategoryRequest;
use App\Models\FoodCategory;
use App\Models\RestaurantCategory;
use App\Services\ImageRealPath;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FoodCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        $foodCategories = FoodCategory::query()
            ->paginate(Controller::DEFAULT_PAGINATE);

        return view('admin.food-category.index', compact('foodCategories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('admin.food-category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreFoodCategoryRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        if ($request->hasFile('image'))
        {
            $imagePath = $request
                ->file('image')
                ->store('/images/food-category', 'public');

            $validated['image'] = "/storage/{$imagePath}";
        }

        $foodCategory = FoodCategory::query()->create($validated);

        return redirect()->route('admin.food-category.index')
            ->with('toast-success', __('response.category_store_success'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(FoodCategory $foodCategory): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('admin.food-category.edit', compact('foodCategory'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateFoodCategoryRequest $request, FoodCategory $foodCategory): RedirectResponse
    {
        $validated = $request->validated();

        if ($request->hasFile('image'))
        {
            if($foodCategory->image)
            {
                $oldImagePath = ImageRealPath::getImageRealPath($foodCategory->image);

                Storage::disk('public')->delete($oldImagePath);
            }

            $imagePath = $request
                ->file('image')
                ->store('/images/food-category', 'public');

            $validated['image'] = "/storage/{$imagePath}";
        }

        $foodCategory->update($validated);

        return redirect()->route('admin.food-category.index')
            ->with('toast-success', __('response.category_update_success'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(FoodCategory $foodCategory): RedirectResponse
    {
        $foodCategory->delete();

        return redirect()->route('admin.food-category.index')
            ->with('toast-success', __('response.category_delete_success'));
    }
}

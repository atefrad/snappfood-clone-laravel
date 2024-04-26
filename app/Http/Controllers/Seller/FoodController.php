<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\Food;
use App\Models\FoodCategory;
use Illuminate\Http\Request;

class FoodController extends Controller
{
    public function index()
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
}

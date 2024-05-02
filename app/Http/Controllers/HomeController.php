<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\RestaurantCategory;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        $activeBanner = Banner::query()->active()->first();

        $restaurantCategories = RestaurantCategory::all();

        return view('home.index', compact('activeBanner', 'restaurantCategories'));
    }
}

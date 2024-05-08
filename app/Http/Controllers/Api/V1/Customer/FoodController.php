<?php

namespace App\Http\Controllers\Api\V1\Customer;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\Customer\FoodCategoryResource;
use App\Http\Resources\V1\Customer\FoodResource;
use App\Models\Restaurant;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class FoodController extends Controller
{
    public function index(Restaurant $restaurant): JsonResponse
    {
        $foodCategories = $restaurant->foodCategories;

        return response()->json([
            'categories' => FoodCategoryResource::collection($foodCategories)
        ], Response::HTTP_OK);
    }
}

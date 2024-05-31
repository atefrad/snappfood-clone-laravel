<?php

namespace App\Http\Controllers\Api\V1\Customer;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\Customer\FoodCategoryResource;
use App\Http\Resources\V1\Customer\FoodSearchResource;
use App\Models\Customer;
use App\Models\Food;
use App\Models\Restaurant;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class FoodController extends Controller
{
    public function index(Restaurant $restaurant): JsonResponse
    {
        $foodCategories = $restaurant->foodCategories()->paginate(1);

        return response()->json([
            'categories' => FoodCategoryResource::collection($foodCategories),
            'meta' => [
                'currentPage' => $foodCategories->currentPage(),
                'perPage' => $foodCategories->perPage(),
                'path' => $foodCategories->path(),
                'nextPage' => $foodCategories->nextPageUrl(),
                'lastPage' => $foodCategories->lastPage(),
                'total' => $foodCategories->total()
            ]
        ], Response::HTTP_OK);
    }

    public function search(): AnonymousResourceCollection
    {
        $radius = 10; //kilometers

        $foods = Food::query()
            ->filterFoodInNearbyRestaurants($radius)
            ->paginate(Controller::DEFAULT_PAGINATE);

        return FoodSearchResource::collection($foods);
    }
}

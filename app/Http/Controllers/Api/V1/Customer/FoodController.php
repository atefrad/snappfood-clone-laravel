<?php

namespace App\Http\Controllers\Api\V1\Customer;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\Customer\FoodCategoryResource;
use App\Http\Resources\V1\Customer\FoodResource;
use App\Models\Customer;
use App\Models\Restaurant;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
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

    public function search()
    {
        /** @var Customer $customer */
        $customer = Auth::guard('customer')->user();
        $currentAddress = $customer->currentAddress;
        $latitude = $currentAddress->latitude;
        $longitude = $currentAddress->longitude;
        $radius = 10; //kilometers

        $restaurants = Restaurant::query()
            ->selectRaw("* ,
            ( 6371 * acos( cos( radians(?) ) *
            cos( radians( latitude ) )
            * cos( radians( longitude ) - radians(?)
            ) + sin(radians(?) ) *
            sin( radians( latitude ) ) )
            ) AS distance", [$latitude, $longitude, $latitude])
//            ->where('active' , 1)
            ->having("distance", "<", $radius)
            ->orderBy("distance", 'asc')
            ->offset(0)
            ->limit(20)
            ->get();

        dd($restaurants);
    }
}

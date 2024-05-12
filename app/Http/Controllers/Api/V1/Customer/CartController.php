<?php

namespace App\Http\Controllers\Api\V1\Customer;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\Customer\Cart\StoreCartRequest;
use App\Http\Resources\V1\Customer\Cart\CartResource;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Food;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CartController extends Controller
{
    public function index()
    {
        $customerId = Auth::guard('customer')->id();

        $carts = Cart::query()->where('customer_id', $customerId)->get();

        dd($carts[0]->foods);
//        return response()->json([
//            'carts' => CartResource::collection($carts)
//        ], Response::HTTP_OK);
    }

    public function store(StoreCartRequest $request): JsonResponse
    {
        $validated = $request->validated();

        if(!isset($validated['cart_id']))
        {
            /** @var Cart $cart */
            $cart = Cart::query()->create($validated);

            $validated['cart_id'] = $cart->id;
        }

        /** @var CartItem $cartItem */
        $cartItem = CartItem::query()->create($validated);

        return response()->json([
            'message' => __('response.cart_store_success'),
            'cart_id' => $cartItem->cart_id
        ], Response::HTTP_OK);
    }
}

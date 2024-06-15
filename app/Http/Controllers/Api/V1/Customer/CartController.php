<?php

namespace App\Http\Controllers\Api\V1\Customer;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\Customer\Cart\StoreCartRequest;
use App\Http\Requests\Api\V1\Customer\Cart\UpdateCartRequest;
use App\Http\Resources\V1\Customer\Cart\CartCollectionResource;
use App\Http\Resources\V1\Customer\Cart\CartResource;
use App\Models\Cart;
use App\Models\CartItem;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

class CartController extends Controller
{
    public function index(): AnonymousResourceCollection
    {
        $customerId = Auth::guard('customer')->id();

        $carts = Cart::query()
            ->where('customer_id', $customerId)
            ->with('restaurant')
            ->paginate(1);

        return CartCollectionResource::collection($carts);
    }

    public function store(StoreCartRequest $request): JsonResponse
    {
        $validated = $request->validated();

        $carts = Cart::query()->customerActiveCart()->get();

        if(in_array($validated['restaurant_id'], $carts->pluck('restaurant_id')->toArray()))
        {
            $cart = $carts->filter(function($cart) use ($validated){
                return $cart->restaurant_id == $validated['restaurant_id'];
            })->values()[0];
        }
        else
        {
            /** @var Cart $cart */
            $cart = Cart::query()->create($validated);
        }

        $validated['cart_id'] = $cart->id;

        /** @var CartItem $cartItem */
        $cartItem = CartItem::query()->create($validated);

        return response()->json([
            'message' => __('response.cart_store_success'),
            'cart' => CartResource::make($cart)
        ], Response::HTTP_OK);
    }

    public function update(UpdateCartRequest $request): JsonResponse
    {
        $validated = $request->validated();

        $carts = Cart::query()->customerActiveCart()->get();

        $cart = $carts->filter(function($cart) use ($validated){
            return $cart->restaurant_id == $validated['restaurant_id'];
        })->values();

        if($cart->count() == 0 || !in_array($validated['food_id'], $cart[0]->foods()->wherePivotNull('deleted_at')->pluck('foods.id')->toArray()))
        {
            return response()->json([
                'message' => __('response.cart_update_error')
            ], Response::HTTP_OK);
        }

        $cart = $cart[0];

        $cartItem = CartItem::query()
            ->where('cart_id', $cart->id)
            ->where('food_id', $validated['food_id'])
            ->firstOrFail();

       if($validated['count'] == 0)
       {
           $cartItem->delete();

           return response()->json([
               'message' => __('response.cartItem_delete_success'),
               'cart' => CartResource::make($cart)
           ], Response::HTTP_OK);
       }

       $cartItem->update([
           'count' => $validated['count']
       ]);

        return response()->json([
            'message' => __('response.cart_update_success'),
            'cart' => CartResource::make($cart)
        ], Response::HTTP_OK);
    }

    public function show(Cart $cart): CartResource
    {
        if(!Gate::allows('view-cart', $cart))
        {
            abort(Response::HTTP_FORBIDDEN);
        }
        return CartResource::make($cart);
    }
}

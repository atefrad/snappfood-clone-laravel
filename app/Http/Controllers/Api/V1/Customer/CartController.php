<?php

namespace App\Http\Controllers\Api\V1\Customer;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\Customer\Cart\StoreCartRequest;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Food;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CartController extends Controller
{
    public function index()
    {

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

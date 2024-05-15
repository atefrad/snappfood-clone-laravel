<?php

namespace App\Http\Controllers\Api\V1\Customer;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\OrderStatus;
use App\Models\Payment;
use App\Providers\CartPayed;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class PaymentController extends Controller
{
    public function store(Cart $cart)
    {
        if($cart->finished_at !== null)
        {
            return response()->json([
                'message' =>  __('response.cart_pay_error')
            ]);
        }

        //store payment
        /** @var Customer $customer */
        $customer = Auth::guard('customer')->user();

        $payment = Payment::query()->create([
            'customer_id' => $customer->id,
            'cart_id' => $cart->id,
            'amount' => $cart->totalPrice,
            'pay_date' => now()
        ]);

        //dispatch cartPayedEvent
        CartPayed::dispatch($cart, $payment);

        //email the customer

        return response()->json([
            'message' => __('response.cart_pay_success')
        ], Response::HTTP_OK);

    }
}

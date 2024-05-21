<?php

namespace App\Http\Controllers\Api\V1\Customer;

use App\Events\CartPayed;
use App\Http\Controllers\Controller;
use App\Http\Resources\V1\Customer\Cart\CartResource;
use App\Mail\OrderSubmitted;
use App\Models\Cart;
use App\Models\Customer;
use App\Models\Payment;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Symfony\Component\HttpFoundation\Response;

class PaymentController extends Controller
{
    public function store(Cart $cart): JsonResponse
    {
        if($cart->finished_at !== null)
        {
            return response()->json([
                'message' =>  __('response.cart_pay_error')
            ]);
        }

        /** @var Customer $customer */
        $customer = Auth::guard('customer')->user();

        try
        {
            DB::beginTransaction();

            //store payment
            $payment = Payment::query()->create([
                'customer_id' => $customer->id,
                'cart_id' => $cart->id,
                'amount' => $cart->totalPrice,
                'pay_date' => now()
            ]);

            //dispatch cartPayedEvent
            CartPayed::dispatch($cart, $payment);

            DB::commit();
        }
        catch(\Throwable $exception)
        {
            DB::rollBack();

            return response()->json([
                'message' =>  __('response.cart_pay_transaction_error')
            ]);
        }

        //email the customer
        Mail::to($customer->email)->send(new OrderSubmitted());

        return response()->json([
            'message' => __('response.cart_pay_success'),
            'cart' => CartResource::make($cart)
        ], Response::HTTP_OK);
    }
}

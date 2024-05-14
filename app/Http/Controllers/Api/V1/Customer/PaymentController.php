<?php

namespace App\Http\Controllers\Api\V1\Customer;

use App\Http\Controllers\Controller;
use App\Models\Cart;

class PaymentController extends Controller
{
    public function store(Cart $cart)
    {
        dd($cart);
    }
}

<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function newOrders()
    {
        return view('seller.dashboard.order.new-orders');
    }
}

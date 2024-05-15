<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderStatus;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index(): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        $seller = Auth::guard('seller')->user();
        $restaurantId = $seller->restaurant->id;

        $newOrders = Order::query()
            ->where('restaurant_id', $restaurantId)
            ->whereNot('order_status_id', OrderStatus::DELIVERED)
            ->paginate(Controller::DEFAULT_PAGINATE);

        $orderStatuses = OrderStatus::all();

        return view('seller.order.index', compact('newOrders', 'orderStatuses'));
    }

    public function destroy()
    {

    }
}

<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Mail\OrderStatusChanged;
use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderStatus;
use App\Models\Seller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class OrderController extends Controller
{
    public function index(): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        /** @var Seller $seller */
        $seller = Auth::guard('seller')->user();

        $restaurantId = $seller->restaurant->id;

        $newOrders = Order::query()
            ->where('restaurant_id', $restaurantId)
            ->whereNot('order_status_id', OrderStatus::DELIVERED)
            ->paginate(Controller::DEFAULT_PAGINATE);

        $orderStatuses = OrderStatus::all();

        return view('seller.order.index', compact('newOrders', 'orderStatuses'));
    }

    public function changeStatus(Order $order): \Illuminate\Http\JsonResponse
    {
        $orderStatus = request('order_status');

        $oldOrderStatus = $order->order_status_id;

        $result = $order->update([
            'order_status_id' => $orderStatus
        ]);

        if($result)
        {
            /** @var Customer $customer */
            $customer = Customer::query()->find($order->customer_id);

            $orderStatusName = $order->orderStatus->name;

            Mail::to($customer->email)->send(new OrderStatusChanged($orderStatusName));

            return response()->json([
                'result' => true,
                'order_status' => $orderStatus,
                'order_status_name' => $orderStatusName
            ]);
        }
        else
        {
            return response()->json([
                'result' => false,
                'order_status' => $oldOrderStatus
            ]);
        }
    }

    public function destroy()
    {

    }
}

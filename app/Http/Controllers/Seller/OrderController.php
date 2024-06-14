<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Mail\OrderDeleted;
use App\Mail\OrderStatusChanged;
use App\Models\Order;
use App\Models\OrderStatus;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Mail;

class OrderController extends Controller
{
    public function index(): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        $newOrders = Order::query()
            ->filterRestaurant()
            ->whereNot('order_status_id', OrderStatus::DELIVERED)
            ->with('customer')
            ->paginate(Controller::DEFAULT_PAGINATE);

        $orderStatuses = OrderStatus::all();

        return view('seller.order.index', compact('newOrders', 'orderStatuses'));
    }

    public function changeStatus(Order $order): \Illuminate\Http\JsonResponse
    {
        $orderStatus = request('order_status');

        $oldOrderStatus = $order->order_status_id;

        if($orderStatus == OrderStatus::DELIVERED)
        {
            $result = $order->update([
                'order_status_id' => $orderStatus,
                'delivery_date' => now()
            ]);
        }
        else
        {
            $result = $order->update([
                'order_status_id' => $orderStatus
            ]);
        }

        if($result)
        {
            $orderStatusName = $order->orderStatus->name;

            Mail::to($order->customer->email)->send(new OrderStatusChanged($orderStatusName));

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

    public function destroy(Order $order): RedirectResponse
    {
        $order->delete();

        Mail::to($order->customer->email)->send(new OrderDeleted());

        return redirect()->route('seller.order.index')
            ->with('toast-success', __('response.order_delete_success'));
    }
}

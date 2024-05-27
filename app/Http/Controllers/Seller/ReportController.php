<?php

namespace App\Http\Controllers\Seller;

use App\Exports\OrderExport;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Seller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class ReportController extends Controller
{
    public function index(): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        /** @var Seller $seller */
        $seller = Auth::guard('seller')->user();

        $restaurantId = $seller->restaurant->id;

        $orders = Order::query()
            ->where('restaurant_id', $restaurantId)
            ->filterDate()
            ->orderBy('created_at', 'desc')
            ->paginate(Controller::DEFAULT_PAGINATE);

        $totalOrders = Order::query()
            ->where('restaurant_id', $restaurantId)
            ->get();

        $orderCount = $totalOrders->count();

        $totalIncome = 0;

        foreach ($totalOrders as $order) {
            $totalIncome += $order->totalFoodPrice;
        }

        return view('seller.report.index', compact('orders', 'orderCount', 'totalIncome'));
    }

    public function export()
    {
        return Excel::download(new OrderExport, 'orders.xlsx');
    }
}

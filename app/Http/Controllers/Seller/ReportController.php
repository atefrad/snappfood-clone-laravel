<?php

namespace App\Http\Controllers\Seller;

use App\Charts\IncomeChart;
use App\Charts\OrderCountChart;
use App\Exports\OrderExport;
use App\Http\Controllers\Controller;
use App\Models\Order;
use Maatwebsite\Excel\Facades\Excel;

class ReportController extends Controller
{
    public function index(): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        $orders = Order::query()
            ->filterRestaurant()
            ->filterDate()
            ->orderBy('created_at', 'desc')
            ->with(['customer', 'orderStatus'])
            ->paginate(Controller::DEFAULT_PAGINATE);

        $totalOrders = Order::query()
            ->filterRestaurant()
            ->with(['orderItems'])
            ->get();

        $orderCount = $totalOrders->count();

        $totalIncome = 0;

        foreach ($totalOrders as $order) {
            $totalIncome += $order->totalFoodPrice;
        }

        return view('seller.report.index', compact('orders', 'orderCount', 'totalIncome'));
    }

    public function export(): \Symfony\Component\HttpFoundation\BinaryFileResponse
    {
        return Excel::download(new OrderExport, 'orders.xlsx');
    }

    public function chart(OrderCountChart $chart, IncomeChart $chart2): \Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $chart = $chart->build();

        $chart2 = $chart2->build();

        return view('seller.report.chart', compact('chart', 'chart2'));
    }
}

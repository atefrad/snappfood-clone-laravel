<?php

namespace App\Exports;

use App\Models\Order;
use App\Models\Seller;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Morilog\Jalali\Jalalian;

class OrderExport implements FromQuery, WithMapping, WithHeadings
{

    public function query()
    {
        /** @var Seller $seller */
        $seller = Auth::guard('seller')->user();

        $restaurantId = $seller->restaurant->id;

        return Order::query()
            ->where('restaurant_id', $restaurantId)
            ->filterDate()
            ->orderBy('created_at', 'desc');
    }

    /**
     * @param Order $order
     * @return array
     */
    public function map($order): array
    {
        $foods = '';
        foreach ($order->orderItems as $orderItem)
        {
            $foods .= $orderItem->food->name . ' -> ' . $orderItem->count . ' عدد - ';
        }

        return [
            $order->customer->name,
            $foods,
            $order->orderStatus->name,
            Jalalian::forge($order->created_at)->format('Y-m-d H:i'),
            $order->totalDiscountAmount,
            $order->totalFoodPrice,
        ];
    }

    public function headings(): array
    {
        return [
            'خریدار',
            'غذاها',
            'وضعیت سفارش',
            'تاریخ ثبت',
            'میزان کل تخفیف',
            'قیمت کل غذاها بعد از تخفیف',
        ];
    }

}

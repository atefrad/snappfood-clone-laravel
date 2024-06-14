<?php

namespace App\Charts;

use App\Models\Order;
use App\Models\Seller;
use ArielMejiaDev\LarapexCharts\LarapexChart;
use Carbon\Carbon;

class OrderCountChart
{
    protected LarapexChart $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\BarChart
    {
        $chartDays = 7;
        $ordersCounts = [];
        $xAxisData = [];

        for($i = 1; $i <= $chartDays; $i ++)
        {
            $day = Carbon::parse("-{$i} day");

            $start = $day->startOfDay()->format("Y-m-d H:i:s");

            $end = $day->endOfDay()->format("Y-m-d H:i:s");

            $dayName = $day->locale('fa')->dayName;

            $orders = Order::query()
                ->filterRestaurant()
                ->filterDate($start, $end)
                ->count();

            $ordersCounts[]= $orders;

            $xAxisData[] = $dayName . " - {$i} روز پیش ";
        }

        return $this->chart->barChart()
            ->addData(' تعداد سفارشات ', $ordersCounts)
            ->setXAxis($xAxisData)
            ->setGrid();
    }
}

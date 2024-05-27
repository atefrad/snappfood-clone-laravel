<?php

namespace App\Charts;

use App\Models\Order;
use ArielMejiaDev\LarapexCharts\LarapexChart;
use Carbon\Carbon;

class IncomeChart
{
    protected LarapexChart $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\BarChart
    {
        $chartDays = 7;
        $xAxisData = [];
        $totalIncomes = [];

        for($i = 1; $i <= $chartDays; $i ++)
        {
            $day = Carbon::parse("-{$i} day");

            $start = $day->startOfDay()->format("Y-m-d H:i:s");

            $end = $day->endOfDay()->format("Y-m-d H:i:s");

            $dayName = $day->locale('fa')->dayName;

            $orders = Order::query()
                ->filterRestaurant()
                ->filterDate($start, $end)
                ->get();

            $xAxisData[] = $dayName . " - {$i} روز پیش ";

            $totalIncome = 0;

            foreach ($orders as $order) {
                $totalIncome += $order->totalFoodPrice;
            }

            $totalIncomes[]= $totalIncome;
        }

        return $this->chart->barChart()
            ->addData('میزان درآمد', $totalIncomes)
            ->setXAxis($xAxisData);
    }
}

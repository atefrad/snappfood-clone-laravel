<?php

namespace Database\Seeders;

use App\Models\OrderStatus;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OrderStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $statusNames = [
            'در حال بررسی',
            'در حال آماده سازی',
            'ارسال به مقصد',
            'تحویل گرفته شد'
        ];

        foreach ($statusNames as $statusName)
        {
            OrderStatus::query()->create([
                'name' => $statusName
            ]);
        }
    }
}

<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\Order;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $orders = Order::all();

        foreach ($orders as $order)
        {
            Comment::factory()->create([
                'customer_id' => $order->customer_id,
                'order_id' => $order->id
            ]);
        }
    }
}

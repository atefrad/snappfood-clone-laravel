<?php

namespace Database\Seeders;

use App\Models\Restaurant;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RestaurantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Restaurant::factory()->create([
            'seller_id' => '1',
            'name' => 'رستوران تستی'
        ]);

        Restaurant::factory(10)->create();
    }
}

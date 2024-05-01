<?php

namespace Database\Seeders;

use App\Models\FoodCategory;
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
        $restaurant = Restaurant::factory()->create([
            'seller_id' => '1',
            'name' => 'رستوران تستی'
        ]);

        $restaurants = Restaurant::factory(10)->create();

        $restaurants[]= $restaurant;

        foreach ($restaurants as $restaurant)
        {
            $foodCategories = FoodCategory::query()
                ->inRandomOrder()
                ->take(rand(2,4))
                ->get();

            /** @var Restaurant $restaurant */

            $restaurant->foodCategories()->attach($foodCategories);
        }
    }
}

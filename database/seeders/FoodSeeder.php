<?php

namespace Database\Seeders;

use App\Models\Food;
use App\Models\FoodCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FoodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $foods = Food::factory(10)->create();

        foreach ($foods as $food)
        {
            $foodCategories = FoodCategory::query()
                ->inRandomOrder()
                ->take(rand(1,3))
                ->get();

            /** @var Food $food */
            $food->foodCategories()->attach($foodCategories);
        }

    }
}

<?php

namespace Database\Seeders;

use App\Models\RestaurantCategory;
use Illuminate\Database\Seeder;

class RestaurantCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        RestaurantCategory::factory(10)->create();
    }
}

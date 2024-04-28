<?php

namespace Database\Seeders;

use App\Models\Food;
use App\Models\FoodParty;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FoodPartySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        FoodParty::factory(5)->create();
    }
}

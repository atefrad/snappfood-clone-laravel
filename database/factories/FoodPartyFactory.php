<?php

namespace Database\Factories;

use App\Models\Food;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\FoodParty>
 */
class FoodPartyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'food_id' => Food::factory()->create(),
            'percentage' => rand(20,70),
            'start_date' => now(),
            'end_date' => now()->addDays(rand(1,3))
        ];
    }
}

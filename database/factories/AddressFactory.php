<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Address>
 */
class AddressFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => ' خانه ' . rand(1,3),
            'address' => fake()->address(),
            'latitude' => fake()->latitude(25, 40),
            'longitude' => fake()->longitude(43, 62),
        ];
    }
}

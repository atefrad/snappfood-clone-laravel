<?php

namespace Database\Seeders;

use App\Models\Seller;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SellerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
//        Seller::factory(10)->create();

        Seller::factory()->create([
            'name' => 'seller',
            'email' => 'seller@example.com'
        ]);
    }
}

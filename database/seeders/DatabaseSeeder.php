<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Database\Factories\AddressFactory;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

         $this->call([
             UserSeeder::class,
             SellerSeeder::class,
             RestaurantCategorySeeder::class,
             FoodCategorySeeder::class,
             RestaurantSeeder::class,
             FoodSeeder::class,
             DiscountSeeder::class,
             FoodPartySeeder::class,
             OrderStatusSeeder::class,
             DeleteRequestStatusSeeder::class,
             CustomerSeeder::class,
             AddressSeeder::class,
             OrderSeeder::class,
             CartItemSeeder::class,
             OrderItemSeeder::class,
             CommentSeeder::class,
         ]);
    }
}

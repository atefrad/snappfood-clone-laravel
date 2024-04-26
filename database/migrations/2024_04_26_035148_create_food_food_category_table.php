<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('food_food_category', function (Blueprint $table) {
            $table->foreignId('food_id')->constrained('foods');
            $table->foreignId('food_category_id')->constrained('food_categories');

            $table->primary(['food_id', 'food_category_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('food_category_food');
    }
};

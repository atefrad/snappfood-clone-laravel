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
        Schema::create('discount_food', function (Blueprint $table) {
            $table->foreignId('food_id')->constrained('foods');
            $table->foreignId('discount_id')->constrained('discounts');

            $table->primary(['food_id', 'discount_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('discount_food');
    }
};

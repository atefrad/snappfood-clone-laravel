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
        Schema::create('food_categoriables', function (Blueprint $table) {
            $table->id();
            $table->foreignId('food_category_id')->constrained('food_categories');
            $table->morphs('food_categoriable', 'food_categoriable_type_food_categoriable_id_
            index');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('food_categoriables');
    }
};

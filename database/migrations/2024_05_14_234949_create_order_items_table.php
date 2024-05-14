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
        Schema::create('order_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')
                ->constrained('orders')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->foreignId('food_id')
                ->constrained('foods')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->unsignedInteger('count')->default(1);
            $table->foreignId('discount_id')
                ->nullable()
                ->constrained('discounts')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->unsignedInteger('discount_percentage')->nullable();
            $table->foreignId('food_party_id')
                ->nullable()
                ->constrained('food_parties')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->unsignedInteger('food_party_percentage')->nullable();
            $table->decimal('final_food_price', 20, 3);
            $table->decimal('final_total_price', 20, 3);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_items');
    }
};

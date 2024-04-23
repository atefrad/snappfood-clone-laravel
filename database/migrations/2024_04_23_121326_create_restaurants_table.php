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
        Schema::create('restaurants', function (Blueprint $table) {
            $table->id();
            $table->foreignId('restaurant_category_id')
                ->constrained('restaurant_categories')
                ->cascadeOnDelete()
                ->cascadeOnUpdate();
            $table->foreignId('seller_id')
                ->constrained('sellers')
                ->cascadeOnDelete()
                ->cascadeOnUpdate();
            $table->string('name');
            $table->json('address');
            $table->string('phone');
            $table->string('bank_account_number');
            $table->text('image')->nullable();
            $table->boolean('is_open')->default(false);
            $table->unsignedInteger('delivery_price')->nullable();
            $table->json('working_time')->nullable();
//            $table->boolean('is_active')->default(true);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('restaurants');
    }
};

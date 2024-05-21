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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cart_id')
                ->constrained('carts')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->foreignId('customer_id')
                ->constrained('customers')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->foreignId('restaurant_id')
                ->constrained('restaurants')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->foreignId('address_id')
                ->constrained('addresses')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->foreignId('payment_id')
                ->constrained('payments')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->foreignId('order_status_id')
                ->constrained('order_statuses')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->timestamp('delivery_date')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};

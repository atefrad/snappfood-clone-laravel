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
        Schema::create('address_customer', function (Blueprint $table) {
            $table->foreignId('address_id')->constrained('addresses');
            $table->foreignId('customer_id')->constrained('customers');
            $table->boolean('current_address')->default(false);

            $table->primary(['address_id', 'customer_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('address_customer');
    }
};

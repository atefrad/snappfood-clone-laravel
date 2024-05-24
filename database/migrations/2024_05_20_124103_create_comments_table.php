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
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')
                ->constrained('customers')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->foreignId('order_id')
                ->constrained('order')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->text('content');
            $table->decimal('score', 3, 2);
            $table->text('answer')->nullable();
            $table->boolean('is_confirmed')->default(false);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comments');
    }
};

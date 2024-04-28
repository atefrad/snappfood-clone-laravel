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
        Schema::create('food_parties', function (Blueprint $table) {
            $table->id();
            $table->foreignId('food_id')
                ->constrained('foods')
                ->cascadeOnDelete()
                ->cascadeOnUpdate();
            $table->integer('percentage');
            $table->timestamp('start_date')->useCurrent();
            $table->timestamp('end_date')->useCurrent();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('food_parties');
    }
};

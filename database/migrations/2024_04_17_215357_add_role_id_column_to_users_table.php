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
        Schema::table('users', function (Blueprint $table) {

            if(!Schema::hasColumn('users', 'role_id'))
            {
                $table->foreignId('role_id')
                    ->after('id')
                    ->constrained('roles')
                    ->cascadeOnUpdate()
                    ->cascadeOnDelete();
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {

            if(Schema::hasIndex('users', 'users_role_id_foreign'))
            {
                $table->dropForeign('users_role_id_foreign');

                $table->dropIndex('users_role_id_foreign');
            }

            if(Schema::hasColumn('users','role_id'))
            {
                $table->dropColumn('role_id');
            }
        });
    }
};

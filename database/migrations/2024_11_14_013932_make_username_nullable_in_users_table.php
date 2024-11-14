<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Drop the existing unique constraint on 'username'
            $table->dropUnique('users_username_unique');  // Drop the existing unique constraint

            // Modify 'username' to be nullable
            $table->string('username')->nullable()->unique()->change();  // Make username nullable and unique
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Drop the unique constraint
            $table->dropUnique('users_username_unique');  

            // Revert 'username' to not nullable
            $table->string('username')->nullable(false)->unique()->change();  // Make 'username' non-nullable again
        });
    }
};

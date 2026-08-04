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
        // Drop unique index on id_number in visitors table
        Schema::table('visitors', function (Blueprint $table) {
            $table->dropUnique(['id_number']);
        });

        // Drop unique index on id_number in interns_attachees table
        Schema::table('interns_attachees', function (Blueprint $table) {
            $table->dropUnique(['id_number']);
        });

        // Drop unique indexes on contractors table
        Schema::table('contractors', function (Blueprint $table) {
            $table->dropUnique(['company_name']);
            $table->dropUnique(['license_number']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('visitors', function (Blueprint $table) {
            $table->string('id_number')->unique()->change();
        });

        Schema::table('interns_attachees', function (Blueprint $table) {
            $table->string('id_number')->unique()->change();
        });

        Schema::table('contractors', function (Blueprint $table) {
            $table->string('company_name')->unique()->change();
            $table->string('license_number')->unique()->change();
        });
    }
};

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
        Schema::table('vehicles', function (Blueprint $table) {
            // Add check-in/out tracking columns
            $table->dateTime('check_in_time')->nullable()->after('driver_license_number');
            $table->dateTime('check_out_time')->nullable()->after('check_in_time');
            $table->enum('visit_status', ['IN', 'OUT'])->default('OUT')->after('check_out_time');
            
            // Add indexes for better query performance
            $table->index('visit_status');
            $table->index('check_in_time');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('vehicles', function (Blueprint $table) {
            $table->dropIndex(['visit_status']);
            $table->dropIndex(['check_in_time']);
            $table->dropColumn(['check_in_time', 'check_out_time', 'visit_status']);
        });
    }
};

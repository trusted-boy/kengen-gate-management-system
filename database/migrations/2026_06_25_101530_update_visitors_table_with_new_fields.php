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
        Schema::table('visitors', function (Blueprint $table) {
            // Add new columns
            $table->string('vehicle_registration')->nullable()->after('phone');
            $table->integer('number_of_visitors')->default(1)->after('vehicle_registration');
            $table->string('reason_for_visit')->nullable()->after('number_of_visitors');
            $table->string('whom_to_see')->nullable()->after('host_name');
            $table->string('signature')->nullable()->after('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('visitors', function (Blueprint $table) {
            $table->dropColumn([
                'vehicle_registration',
                'number_of_visitors',
                'reason_for_visit',
                'whom_to_see',
                'signature',
            ]);
        });
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('vehicles', function (Blueprint $table) {
            $table->unsignedInteger('current_odometer_km')->default(0);
            $table->unsignedInteger('last_service_mileage_km')->default(0);
            $table->unsignedInteger('service_interval_km')->default(5000);

            $table->date('last_service_date')->nullable();

            // Optional: keep historical/operational notes
            $table->text('service_remarks')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('vehicles', function (Blueprint $table) {
            $table->dropColumn([
                'current_odometer_km',
                'last_service_mileage_km',
                'service_interval_km',
                'last_service_date',
                'service_remarks',
            ]);
        });
    }
};


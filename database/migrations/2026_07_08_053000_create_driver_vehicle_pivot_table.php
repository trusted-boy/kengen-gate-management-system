<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        // NOTE: Schema for driver_vehicles migration was generated automatically but is missing columns.
        // This migration creates the complete pivot schema.
        Schema::table('driver_vehicles', function (Blueprint $table) {
            $table->unsignedBigInteger('driver_id');
            $table->unsignedBigInteger('vehicle_id');

            $table->foreign('driver_id')->references('id')->on('drivers')->cascadeOnDelete();
            $table->foreign('vehicle_id')->references('id')->on('vehicles')->cascadeOnDelete();

            $table->unique(['driver_id', 'vehicle_id']);

            $table->index(['driver_id']);
            $table->index(['vehicle_id']);
        });
    }

    public function down(): void
    {
        Schema::table('driver_vehicles', function (Blueprint $table) {
            $table->dropUnique(['driver_id', 'vehicle_id']);
            $table->dropIndex(['driver_id']);
            $table->dropIndex(['vehicle_id']);

            $table->dropForeign(['driver_id']);
            $table->dropForeign(['vehicle_id']);

            $table->dropColumn(['driver_id', 'vehicle_id']);
        });
    }
};


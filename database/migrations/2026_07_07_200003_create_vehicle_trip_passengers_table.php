<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('vehicle_trip_passengers', function (Blueprint $table) {
            $table->id();

            $table->foreignId('vehicle_trip_id')->constrained()->cascadeOnUpdate()->restrictOnDelete();

            $table->unsignedInteger('staff_count')->default(0);
            $table->unsignedInteger('attachee_count')->default(0);
            $table->unsignedInteger('contractor_count')->default(0);
            $table->unsignedInteger('visitor_count')->default(0);

            $table->unsignedInteger('total_occupants')->default(0);

            // Optional storage for names (CSV) to avoid over-normalization in early phase.
            $table->text('staff_names')->nullable();
            $table->text('attachee_names')->nullable();
            $table->text('contractor_names')->nullable();
            $table->text('visitor_names')->nullable();

            $table->timestamps();

            $table->unique('vehicle_trip_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('vehicle_trip_passengers');
    }
};


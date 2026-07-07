<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('vehicle_trips', function (Blueprint $table) {
            $table->id();

            $table->foreignId('vehicle_id')->constrained()->cascadeOnUpdate()->restrictOnDelete();
            $table->foreignId('driver_id')->constrained()->cascadeOnUpdate()->restrictOnDelete();

            $table->string('departure_gate');
            $table->string('return_gate');

            $table->string('destination');
            $table->string('purpose_of_trip');

            $table->dateTime('departure_at');
            $table->dateTime('expected_return_at');
            $table->dateTime('actual_return_at')->nullable();

            $table->unsignedInteger('departure_odometer_km');
            $table->unsignedInteger('return_odometer_km')->nullable();
            $table->unsignedInteger('distance_km')->default(0);

            $table->text('remarks')->nullable();

            $table->enum('status', ['Active', 'Completed', 'Overdue'])->default('Active');

            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->timestamps();

            $table->index(['vehicle_id', 'departure_at']);
            $table->index(['driver_id', 'departure_at']);
            $table->index(['status']);
        });

        // created_by/updated_by FK (users)
        Schema::table('vehicle_trips', function (Blueprint $table) {
            $table->foreign('created_by')->references('id')->on('users')->nullOnDelete();
            $table->foreign('updated_by')->references('id')->on('users')->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('vehicle_trips');
    }
};


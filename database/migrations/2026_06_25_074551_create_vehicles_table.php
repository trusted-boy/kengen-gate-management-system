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
        Schema::create('vehicles', function (Blueprint $table) {
            $table->id();
            $table->string('registration_number')->unique();
            $table->string('vehicle_type');
            $table->string('make_model');
            $table->year('year');
            $table->string('color')->nullable();
            $table->string('owner_name');
            $table->string('owner_contact');
            $table->string('driver_name')->nullable();
            $table->string('driver_license_number')->nullable();
            $table->enum('status', ['Active', 'Inactive', 'Under Maintenance'])->default('Active');
            $table->text('remarks')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicles');
    }
};

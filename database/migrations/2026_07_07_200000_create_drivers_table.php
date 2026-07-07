<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('drivers', function (Blueprint $table) {
            $table->id();

            $table->string('employee_id')->unique()->nullable();
            $table->string('full_name');
            $table->string('phone')->nullable();

            $table->string('license_number')->unique()->nullable();
            $table->date('license_expiry_date')->nullable();

            $table->string('license_category')->nullable();

            $table->enum('status', ['Active', 'Inactive'])->default('Active');
            $table->text('remarks')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('drivers');
    }
};


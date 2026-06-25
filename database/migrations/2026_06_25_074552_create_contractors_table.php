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
        Schema::create('contractors', function (Blueprint $table) {
            $table->id();
            $table->string('company_name')->unique();
            $table->string('contact_person');
            $table->string('email');
            $table->string('phone');
            $table->string('license_number')->unique();
            $table->date('license_expiry');
            $table->text('services_offered');
            $table->enum('status', ['Active', 'Inactive', 'Expired'])->default('Active');
            $table->text('remarks')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contractors');
    }
};

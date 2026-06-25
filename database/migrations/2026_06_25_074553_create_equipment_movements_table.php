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
        Schema::create('equipment_movements', function (Blueprint $table) {
            $table->id();
            $table->string('equipment_name');
            $table->string('description')->nullable();
            $table->string('equipment_type');
            $table->string('owner_name');
            $table->string('recipient_name');
            $table->dateTime('check_out_time');
            $table->dateTime('check_in_time')->nullable();
            $table->enum('status', ['In', 'Out'])->default('Out');
            $table->text('purpose');
            $table->text('remarks')->nullable();
            $table->unsignedBigInteger('authorized_by_user_id')->nullable();
            $table->timestamps();
            $table->foreign('authorized_by_user_id')->references('id')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('equipment_movements');
    }
};

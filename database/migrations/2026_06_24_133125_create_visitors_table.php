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
        Schema::create('visitors', function (Blueprint $table) {
    $table->id();
    $table->string('full_name');
    $table->string('id_number')->unique();
    $table->string('phone')->nullable();
    $table->string('organization')->nullable();
    $table->string('host_name');
    $table->string('department');
    $table->text('purpose');
    $table->dateTime('check_in_time');
    $table->dateTime('check_out_time')->nullable();
    $table->enum('status', ['IN', 'OUT'])->default('IN');
    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('visitors');
    }
};

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
        Schema::create('clinicians_shifts', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id');
            $table->bigInteger('shift_id');
            $table->text('location_name')->nullable();
            $table->dateTime('clockin')->nullable();
            $table->dateTime('clockout')->nullable();
            $table->decimal('lat', 16, 12)->nullable();
            $table->decimal('lon', 16, 12)->nullable();
            $table->tinyInteger('shift_status')->nullable();
            $table->tinyInteger('status')->comment('1 is Accepted and 2 is Rejected')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clinicians_shifts');
    }
};

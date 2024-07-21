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
        Schema::create('shifts', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id');
            $table->bigInteger('mf_clinician_type_id');
            $table->bigInteger('mf_shift_hour_id');
            $table->bigInteger('country_id')->nullable();
            $table->bigInteger('state_id')->nullable();
            $table->bigInteger('city_id')->nullable();
            $table->string('title');
            $table->date('date');
            $table->string('shift_hour');
            $table->decimal('rate_per_hour', 65,2);
            $table->decimal('total_amount', 65,2);
            $table->text('additional_comments')->nullable();
            $table->text('address')->nullable();
            $table->string('zip_code');
            $table->tinyInteger('status')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shifts');
    }
};

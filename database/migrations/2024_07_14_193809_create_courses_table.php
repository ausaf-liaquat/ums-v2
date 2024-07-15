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
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('country_id');
            $table->bigInteger('state_id');
            $table->bigInteger('city_id');
            $table->string('name');
            $table->string('slug');
            $table->text('description')->nullable();
            $table->text('address')->nullable();
            $table->text('slot')->nullable();
            $table->string('zip_code')->nullable();
            $table->decimal('price', 65, 2)->nullable();
            $table->text('image')->nullable();
            $table->tinyInteger('type')->default(0)->comment('0 for manual and 1 for online');
            $table->tinyInteger('status')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('courses');
    }
};

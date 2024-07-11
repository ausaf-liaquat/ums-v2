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
        Schema::create('product_variant_color_sizes', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('product_variant_id')->index();
            $table->bigInteger('mf_color_id')->index();
            $table->bigInteger('size_id')->index();
            $table->integer('quantity')->default(0); // Inventory quantity
            $table->json('images')->nullable(); // Store images as JSON
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_variant_color_sizes');
    }
};

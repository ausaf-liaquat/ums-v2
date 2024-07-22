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
        Schema::create('frontend_contents', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('frontend_page_id');
            $table->string('mf_content_type_id');
            $table->text('content_title')->nullable();
            $table->text('content_file')->nullable();
            $table->longText('content_text')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('frontend_contents');
    }
};

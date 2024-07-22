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
        Schema::table('users', function (Blueprint $table) {
            $table->string('zip_code')->after('address')->nullable();
            $table->longText('shifts')->after('last_login')->nullable();
            $table->string('experience')->after('last_login')->nullable();
            $table->string('reffered_by')->after('last_login')->nullable();
            $table->string('qualification_type')->after('last_login')->nullable();
            $table->text('resume')->after('last_login')->nullable();
            $table->string('otp')->after('last_login')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
};

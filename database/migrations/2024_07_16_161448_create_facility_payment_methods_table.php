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
        Schema::create('facility_payment_methods', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('facility_id');
            $table->bigInteger('country_id')->nullable();
            $table->bigInteger('state_id')->nullable();
            $table->bigInteger('city_id')->nullable();
            $table->string('bank_name')->nullable();
            $table->string('routing_number')->default('0');
            $table->string('account_number')->default('0');
            $table->string('first')->nullable();
            $table->string('middle')->nullable();
            $table->string('last')->nullable();
            $table->string('card_type')->nullable();
            $table->string('card_number')->nullable();
            $table->string('exp_month')->nullable();
            $table->string('exp_year')->nullable();
            $table->string('security_code')->nullable();
            $table->text('billing_address_1')->nullable();
            $table->text('billing_address_2')->nullable();
            $table->string('zip_code')->nullable();
            $table->tinyInteger('status')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('facility_payment_methods_tables');
    }
};

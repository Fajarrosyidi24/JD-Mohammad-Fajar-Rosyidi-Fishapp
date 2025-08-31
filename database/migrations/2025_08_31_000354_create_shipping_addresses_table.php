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
        Schema::create('shipping_addresses', function (Blueprint $table) {
            $table->id();
            $table->string('full_name');
            $table->string('email')->nullable();
            $table->string('country_code');
            $table->string('phone');
            $table->string('country');
            $table->string('address');
            $table->string('state')->nullable();
            $table->tinytext('province_id')->nullable();
            $table->string('city')->nullable();
            $table->tinytext('city_id')->nullable();
            $table->tinytext('subdistrict')->nullable();
            $table->tinytext('subdistrict_id')->nullable();
            $table->tinytext('vilage')->nullable();
            $table->tinytext('vilage_id')->nullable();
            $table->string('zip_code')->nullable();
            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();
            $table->foreignId('user_id')->constrained('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shipping_addresses');
    }
};

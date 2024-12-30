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
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('image_path')->nullable();
            $table->string('country_id');
            $table->string('state_id');
            $table->string('city_id');
            $table->string('address1');
            $table->string('address2')->nullable();
            $table->string('gender', 10)->nullable();
            $table->string('dot_number')->nullable();
            $table->string('mc_number')->nullable();
            $table->string('zip_code')->nullable();
            $table->string('payment_method')->nullable();
            $table->string('currency')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profiles');
    }
};

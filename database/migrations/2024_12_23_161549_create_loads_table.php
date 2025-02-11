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
        Schema::create('loads', function (Blueprint $table) {
            $table->id();
            $table->string('description')->nullable();
            $table->date('pickup_date')->nullable();
            $table->date('delivery_date')->nullable();
            $table->decimal('weight', 10, 2)->nullable();

            $table->string('pickup_state');
            $table->string('pickup_time_range');
            $table->string('pickup_address');
            $table->string('loading_method');
            $table->string('temperature')->nullable();
            $table->string('commodities');
            $table->string('rate');
            $table->unsignedBigInteger('driver_id')->nullable();
            $table->unsignedBigInteger('vehicle_id')->nullable();
            $table->unsignedBigInteger('dispatcher_id')->nullable();
            $table->string('fee_type')->nullable();
            $table->decimal('amount', 18, 2)->default(0.00);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('loads');
    }
};

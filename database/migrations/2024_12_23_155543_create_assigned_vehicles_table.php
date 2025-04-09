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
        Schema::create('assigned_vehicles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id')->constrained()->onDelete('cascade');
            $table->foreignId('driver_id')->constrained('users')->onDelete('cascade')->onUpdate('cascade');
            $table->date('date_assigned');
            $table->integer('status')->nullable();
            $table->date('dropped_date');
            $table->unsignedBigInteger('load_id');
            $table->string('layover')->nullable();
            $table->decimal('layover_amount', 10, 2)->nullable();
            $table->integer('payment_status')->default(0);
            $table->integer('payroll_status')->default(0);
            $table->string('truck')->nullable();
            $table->string('trailer')->nullable();
            $table->string('tractor')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assigned_vehicles');
    }
};

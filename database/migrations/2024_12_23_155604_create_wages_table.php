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
        Schema::create('wages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id')->constrained()->onDelete('cascade');
            $table->foreignId('driver_id')->constrained('users')->onDelete('cascade')->onUpdate('cascade');
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->decimal('gross_pay', 10, 2);
            $table->decimal('amount_paid', 10, 2)->nullable();
            $table->date('date_paid');
            $table->time('time_paid');
            $table->text('comment')->nullable();
            $table->string('payment_method')->nullable();
            $table->decimal('balance', 10, 2)->nullable();
            $table->decimal('balance_paid', 10, 2)->nullable();
            $table->date('balance_paid_date')->nullable();
            $table->time('balance_paid_time')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wages');
    }
};

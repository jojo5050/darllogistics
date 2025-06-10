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
        Schema::dropIfExists('invoices');
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->foreignId('route_id')->constrained()->onDelete('cascade');
            $table->unsignedBigInteger('user_id')->constrained()->onDelete('cascade');
            $table->decimal('total_earning', 11, 2)->default(0.00);
            $table->decimal('driver_earning', 11, 2)->default(0.00);
            $table->decimal('dispatcher_earning', 11, 2)->default(0.00);
            $table->decimal('vat')->default(0.00);
            $table->decimal('discount')->default(0.00);
            $table->string('comment')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {

    }
};

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
        Schema::create('extra_fees', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('route_id')->constrained()->onDelete('cascade');
            $table->string('feeType')->nullable();
            $table->decimal('amount', 11, 2)->default(0.00);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('extra_fees');
    }
};

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
        Schema::create('route_jobs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('route_id')->constrained('routes')->onDelete('cascade');
            $table->enum('jobType', ['pickup', 'delivery']);
            $table->string('address')->nullable();
            $table->date('date')->nullable();
            $table->time('time')->nullable();
            $table->text('jobDescription')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('appointmentID')->nullable();
            $table->string('trailerType')->nullable();
            $table->string('loadingMethod')->nullable();
            $table->text('goodsDescription')->nullable();
            $table->decimal('rate', 10, 2)->nullable();
            $table->integer('quantity')->nullable();
            $table->string('weightType')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('route_jobs');
    }
};

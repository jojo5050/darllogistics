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
        Schema::create('drivers_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('rate_confirmation_id')->unique()->nullable();
            $table->string('rate_confirmation')->unique()->nullable();
            $table->timestamp('date_uploaded')->useCurrent();
            $table->time('time_uploaded')->nullable();
            $table->unsignedBigInteger('uploaded_by')->nullable();
            $table->boolean('status');
            $table->text('comment')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('drivers_logs');
    }
};

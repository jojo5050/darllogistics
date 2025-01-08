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
        Schema::table('loads', function (Blueprint $table) {
            $table->string('broker_name')->after('weight')->nullable();
            $table->string('broker_email')->nullable();
            $table->string('broker_number')->nullable();
            $table->string('shipper_email')->nullable();
            $table->string('shipper_address')->nullable();
            $table->string('status')->nullable();
            $table->unsignedBigInteger('user_id')->constrained()->onDelete('cascade');
            $table->string('rate')->nullable();
            $table->string('rate_confirmation_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('loads', function (Blueprint $table) {
            //
        });
    }
};

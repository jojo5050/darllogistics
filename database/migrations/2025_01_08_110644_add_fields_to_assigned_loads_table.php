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
        Schema::table('assigned_loads', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->nullable()->constrained()->onDelete('cascade');
            $table->foreignId('sub_dispatcher')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('assigned_loads', function (Blueprint $table) {
            //
        });
    }
};

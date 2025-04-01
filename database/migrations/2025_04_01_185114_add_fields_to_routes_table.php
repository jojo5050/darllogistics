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
        Schema::table('routes', function (Blueprint $table) {
            $table->string('load_name')->nullable();
            $table->integer('load_number')->default(0);
            $table->string('broker_name')->nullable();
            $table->string('broker_email')->nullable();
            $table->decimal('rate', 11, 2)->default(0);
            $table->foreignId('dispatcher_id')->constrained('users')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('routes', function (Blueprint $table) {
            $table->dropColumn('load_name');
            $table->dropColumn('load_number');
            $table->dropColumn('broker_name');
            $table->dropColumn('broker_email');
            $table->dropColumn('rate');
            $table->dropColumn('dispatcher_id');
        });
    }
};

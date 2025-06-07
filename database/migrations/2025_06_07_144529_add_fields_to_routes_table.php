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
            $table->decimal('flat_rate', 10, 2)->default('0.00');
            $table->enum('mc_type', ['internal_mc', 'external_mc'])->default('internal_mc');
            $table->string('dispatcher_fee', 11)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('routes', function (Blueprint $table) {
            $table->dropColumn('flat_rate');
            $table->dropColumn('mc_type');
            $table->dropColumn('dispatcher_fee');
        });
    }
};

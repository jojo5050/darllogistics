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
        Schema::table('profiles', function (Blueprint $table) {
            $table->string('country_id')->nullable()->change();
            $table->string('state_id')->nullable()->change();
            $table->string('city_id')->nullable()->change();
            $table->string('address1')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('profiles', function (Blueprint $table) {
            $table->string('country_id')->nullable(false)->change();
            $table->string('state_id')->nullable(false)->change();
            $table->string('city_id')->nullable(false)->change();
            $table->string('address1')->nullable(false)->change();
        });
    }
};

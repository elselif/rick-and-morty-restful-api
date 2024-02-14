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
        Schema::table('characters', function (Blueprint $table) {
            $table->unsignedBigInteger('location_id')->nullable();
            $table->unsignedBigInteger('origin_id')->nullable();

            $table->foreign('location_id')->references('id')->on('locations')->onDelete('cascade');
            $table->foreign('origin_id')->references('id')->on('locations')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('characters', function (Blueprint $table) {
            $table->dropForeign(['location_id']);
            $table->dropForeign(['origin_id']);
            $table->dropColumn(['location_id', 'origin_id']);
        });
    }
};

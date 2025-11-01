<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::table('booking_room_histories', function (Blueprint $table) {
            $table->boolean('is_billed')->default(false);
        });

        Schema::table('booking_charges', function (Blueprint $table) {
            $table->boolean('is_billed')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::table('booking_room_histories', function (Blueprint $table) {
            $table->dropColumn('is_billed');
        });
        Schema::table('booking_charges', function (Blueprint $table) {
            $table->dropColumn('is_billed');
        });
    }
};

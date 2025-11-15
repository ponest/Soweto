<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::table('conference_bookings', function (Blueprint $table) {
            $table->foreignId('institution_id')->after('conference_room_id')->constrained();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::table('conference_bookings', function (Blueprint $table) {
            $table->dropForeign('conference_bookings_institution_id_foreign');
            $table->dropColumn('institution_id');
        });
    }
};

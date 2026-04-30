<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('room_check_in_outs', function (Blueprint $table) {
            $table->integer('pax')->nullable()->after('checked_out_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('room_check_in_outs', function (Blueprint $table) {
            $table->dropColumn('pax');
        });
    }
};

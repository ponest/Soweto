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
        Schema::table('bookings', function (Blueprint $table) {
            $table->dropColumn('price');
            $table->renameColumn('check_in_date', 'proposed_start_date');
            $table->renameColumn('check_out_date', 'proposed_end_date');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {}
};

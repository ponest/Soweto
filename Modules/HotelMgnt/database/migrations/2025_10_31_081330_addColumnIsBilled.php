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
        Schema::table('room_check_in_outs', function (Blueprint $table) {
            $table->boolean('is_billed')->default(false);
            $table->foreignId('billed_by')->nullable()->constrained('users');
            $table->dateTime('billed_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {}
};

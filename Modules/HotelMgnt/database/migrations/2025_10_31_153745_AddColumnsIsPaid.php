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
            $table->boolean('is_paid')->default(false);
            $table->decimal('paid_amount')->default(0);
            $table->string('payment_method')->nullable();
            $table->string('payment_reference')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::table('room_check_in_outs', function (Blueprint $table) {
            $table->dropColumn('is_paid');
            $table->dropColumn('paid_amount');
            $table->dropColumn('payment_method');
            $table->dropColumn('payment_reference');
        });
    }
};

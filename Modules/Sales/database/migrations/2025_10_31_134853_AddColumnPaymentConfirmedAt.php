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
        Schema::table('bills', function (Blueprint $table) {
           $table->dateTime('payment_confirmed_at')->nullable();
           $table->foreignId('payment_confirmed_by')->nullable()->constrained('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::table('bills', function (Blueprint $table) {
            $table->dropForeign('bills_payment_confirmed_by_foreign');
            $table->dropColumn('payment_confirmed_by');
            $table->dropColumn('payment_confirmed_at');
        });
    }
};

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
        Schema::table('client_wallets', function (Blueprint $table) {
           $table->foreignId('payment_method_id')->nullable()->constrained()->after('reference_no');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::table('client_wallets', function (Blueprint $table) {
            $table->dropForeign('client_wallets_payment_method_id_foreign');
            $table->dropColumn('payment_method_id');
        });
    }
};

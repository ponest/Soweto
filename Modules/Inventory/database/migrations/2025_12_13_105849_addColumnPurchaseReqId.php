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
        Schema::table('item_stock_in', function (Blueprint $table) {
            $table->foreignId('purchase_request_id')->nullable()->constrained();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::table('item_stock_in', function (Blueprint $table) {
            $table->dropForeign('item_stock_in_purchase_request_id_foreign');
            $table->dropColumn('purchase_request_id');
        });
    }
};

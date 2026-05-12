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
        Schema::table('purchase_req_items', function (Blueprint $table) {
            $table->decimal('amended_unit_price',18)->default(0);
            $table->decimal('amended_total_price',18)->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::table('purchase_req_items', function (Blueprint $table) {
            $table->dropColumn('amended_unit_price');
            $table->dropColumn('amended_total_price');
        });
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::table('stock_issue_items', function (Blueprint $table) {
            $table->unsignedBigInteger('issuing_store_id')->nullable()->after('store_id');
            $table->foreign('issuing_store_id')->references('id')->on('stores');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::table('stock_issue_items', function (Blueprint $table) {
            $table->dropColumn('issuing_store_id');
        });
    }
};

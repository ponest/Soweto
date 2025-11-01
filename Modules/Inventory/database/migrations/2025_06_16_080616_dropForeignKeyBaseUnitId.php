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
        Schema::table('stock_items', function (Blueprint $table) {
            $table->dropForeign('stock_items_base_unit_id_foreign');
        });

        Schema::table('stock_items', function (Blueprint $table) {
           $table->renameColumn('base_unit_id', 'bulk_unit_id');
        });

        Schema::table('stock_items', function (Blueprint $table) {
            $table->foreign('bulk_unit_id')->references('id')->on('units');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {}
};

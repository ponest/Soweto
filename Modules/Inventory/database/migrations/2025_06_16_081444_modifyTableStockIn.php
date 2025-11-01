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
            $table->dropForeign('item_stock_in_base_unit_id_foreign');
            $table->dropForeign('item_stock_in_converted_unit_id_foreign');
        });

        Schema::table('item_stock_in', function (Blueprint $table) {
           $table->renameColumn('base_unit_id', 'unit_id');
           $table->renameColumn('base_quantity', 'quantity');
           $table->renameColumn('converted_unit_id', 'bulk_unit_id');
           $table->renameColumn('converted_quantity', 'bulk_quantity');
        });

        Schema::table('item_stock_in', function (Blueprint $table) {
            $table->foreign('unit_id')->references('id')->on('units');
            $table->foreign('bulk_unit_id')->references('id')->on('units');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {}
};

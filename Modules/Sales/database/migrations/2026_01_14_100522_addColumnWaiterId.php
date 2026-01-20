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
        Schema::table('bill_items', function (Blueprint $table) {
            $table->foreignId('waiter_id')->nullable()->constrained('staffs');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::table('bill_items', function (Blueprint $table) {
            $table->dropForeign('bill_items_waiter_id_foreign');
            $table->dropColumn('waiter_id');
        });
    }
};

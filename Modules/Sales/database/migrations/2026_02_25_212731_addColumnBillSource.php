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
           $table->string('bill_source')->nullable()->after('total_price');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::table('bill_items', function (Blueprint $table) {
            $table->dropColumn('bill_source');
        });
    }
};

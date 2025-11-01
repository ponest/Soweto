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
            $table->unsignedBigInteger('ref_id')->nullable()->after('reference_no');
            $table->string('category')->nullable()->after('ref_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::table('bills', function (Blueprint $table) {
            $table->dropColumn('ref_id');
            $table->dropColumn('category');
        });
    }
};

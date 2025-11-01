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
        Schema::table("bills", function (Blueprint $table) {
            $table->string("payment_method")->nullable();
            $table->string("payment_reference")->nullable();
            $table->decimal("discount_amount")->nullable();
            $table->string("discount_reference")->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::table("bills", function (Blueprint $table) {
            $table->dropColumn("payment_method");
            $table->dropColumn("payment_reference");
            $table->dropColumn("discount_amount");
            $table->dropColumn("discount_reference");
        });
    }
};

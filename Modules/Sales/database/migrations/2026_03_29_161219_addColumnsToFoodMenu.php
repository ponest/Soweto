<?php

use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::table('food_menus', function ($table) {
            $table->boolean('is_company')->default(false);
            $table->boolean('has_company')->default(true);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::table('food_menus', function ($table) {
           $table->dropColumn('is_company');
           $table->dropColumn('has_company');
        });
    }
};

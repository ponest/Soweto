<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('purchase_req_items', function (Blueprint $table) {
            $table->decimal('bulk_quantity', 18, 2)->after('quantity')->nullable();
            $table->foreignId('bulk_unit_id')->after('unit_id')->nullable()->constrained('units');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('purchase_req_items', function (Blueprint $table) {
            $table->dropColumn('bulk_quantity');
            $table->dropColumn('bulk_unit_id');
        });
    }
};

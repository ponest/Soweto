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
        Schema::table('purchase_requests', function (Blueprint $table) {
            $table->foreignId('previewed_by')->nullable()->after('submitted_at')->constrained('users');
            $table->dateTime('previewed_at')->nullable()->after('previewed_by');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('purchase_requests', function (Blueprint $table) {
            $table->dropForeign('purchase_requests_previewed_by_foreign');
            $table->dropColumn('previewed_by');
            $table->dropColumn('previewed_at');
        });
    }
};

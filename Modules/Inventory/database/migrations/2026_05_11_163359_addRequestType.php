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
        Schema::table('purchase_requests', function (Blueprint $table) {
            $table->string('request_type')->default('New')->after('reject_comments');
            $table->foreignId('parent_id')->nullable()->constrained('purchase_requests')->after('request_type');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::table('purchase_requests', function (Blueprint $table) {
            //drop column here
        });
    }
};

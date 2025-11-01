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
        Schema::table('stock_issue', function (Blueprint $table) {
            $table->unsignedBigInteger('received_by')->nullable()->after('issued_at');
            $table->date('received_at')->nullable()->after('received_by');
            //foreign key
            $table->foreign('received_by')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {}
};

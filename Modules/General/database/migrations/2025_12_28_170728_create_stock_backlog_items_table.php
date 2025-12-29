<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('stock_backlog_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('backlog_request_id')->constrained('stock_backlog_requests');
            $table->foreignId('stock_item_id')->constrained();
            $table->double('quantity');
            $table->foreignId('unit_id')->constrained();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stock_backlog_items');
    }
};

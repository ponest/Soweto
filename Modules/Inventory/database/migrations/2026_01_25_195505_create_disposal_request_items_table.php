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
        Schema::create('disposal_request_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('disposal_request_id')->constrained();
            $table->foreignId('stock_item_id')->constrained();
            $table->foreignId('unit_id')->constrained();
            $table->foreignId('store_id')->constrained();
            $table->decimal('quantity');
            $table->text('remarks')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('disposal_request_items');
    }
};

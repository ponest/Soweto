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
        Schema::create('price_approval_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('price_approval_id');
            $table->unsignedBigInteger('item_id');
            $table->decimal('price');
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('price_approval_id')->references('id')->on('item_price_approvals');
            $table->foreign('item_id')->references('id')->on('stock_items');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('price_approval_items');
    }
};

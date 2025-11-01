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
        Schema::create('item_stock_out', function (Blueprint $table) {
            $table->id();
            $table->string('category'); //eg. Transfer,Sales,Disposal etc
            $table->unsignedBigInteger('item_id');
            $table->decimal('quantity');
            $table->unsignedBigInteger('unit_id');
            $table->unsignedBigInteger('store_id');
            $table->timestamps();
            $table->softDeletes();

            //foreign Keys
            $table->foreign('item_id')->references('id')->on('stock_items');
            $table->foreign('store_id')->references('id')->on('stores');
            $table->foreign('unit_id')->references('id')->on('units');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('item_stock_out');
    }
};

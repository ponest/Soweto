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
        Schema::create('daily_stock_sheets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('stock_item_id')->constrained('stock_items');
            $table->foreignId('store_id')->constrained('stores');
            $table->decimal('opening_stock',20)->nullable();
            $table->decimal('additional_stock',20);
            $table->decimal('total_stock',20);
            $table->decimal('closing_stock',20);
            $table->decimal('sold_qty',20);
            $table->decimal('unit_price',20);
            $table->decimal('total_price',20);
            $table->date('date');
            $table->decimal('day');
            $table->string('month');
            $table->string('year');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('daily_stock_sheets');
    }
};

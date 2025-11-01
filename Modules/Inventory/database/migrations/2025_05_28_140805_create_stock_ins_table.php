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
        Schema::create('item_stock_in', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('item_id');
            $table->unsignedBigInteger('supplier_id');
            $table->float('base_quantity');
            $table->unsignedBigInteger('base_unit_id');
            $table->float('converted_quantity')->nullable();
            $table->unsignedBigInteger('converted_unit_id')->nullable();
            $table->float('unit_price');
            $table->float('total_price');
            $table->date('received_date');
            $table->unsignedBigInteger('department_id')->nullable();
            $table->timestamps();
            $table->softDeletes();
            //foreign Key
            $table->foreign('item_id')->references('id')->on('stock_items');
            $table->foreign('supplier_id')->references('id')->on('suppliers');
            $table->foreign('base_unit_id')->references('id')->on('units');
            $table->foreign('converted_unit_id')->references('id')->on('units');
            $table->foreign('department_id')->references('id')->on('departments');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('item_stock_in');
    }
};

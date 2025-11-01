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
        Schema::create('stock_requisition_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('stock_requisition_id');
            $table->unsignedBigInteger('stock_item_id');
            $table->unsignedBigInteger('unit_id');
            $table->float('requested_quantity');
            $table->float('issued_quantity')->nullable();
            $table->boolean('is_issued')->default(false);
            $table->boolean('is_received')->default(false);
            $table->timestamps();
            $table->softDeletes();
            //foreign Key
            $table->foreign('stock_requisition_id')->references('id')->on('stock_requisitions');
            $table->foreign('stock_item_id')->references('id')->on('stock_items');
            $table->foreign('unit_id')->references('id')->on('units');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stock_requisition_items');
    }
};

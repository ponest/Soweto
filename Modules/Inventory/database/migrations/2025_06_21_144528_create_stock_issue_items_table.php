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
        Schema::create('stock_issue_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('stock_issue_id');
            $table->string('requisition_number');
            $table->unsignedBigInteger('item_id');
            $table->float('quantity');
            $table->unsignedBigInteger('unit_id');
            $table->dateTime('issued_at');
            $table->unsignedBigInteger('stock_requisition_item_id');
            $table->unsignedBigInteger('department_id');
            $table->timestamps();
            $table->softDeletes();
            //Foreign Keys
            $table->foreign('stock_issue_id')->references('id')->on('stock_issue');
            $table->foreign('item_id')->references('id')->on('stock_items');
            $table->foreign('unit_id')->references('id')->on('units');
            $table->foreign('stock_requisition_item_id')->references('id')->on('stock_requisition_items');
            $table->foreign('department_id')->references('id')->on('departments');
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stock_issue_items');
    }
};

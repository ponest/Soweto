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
        Schema::create('stock_items', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('base_unit_id');
            $table->unsignedBigInteger('unit_id');
            $table->integer('reorder_level')->default(1);
            $table->timestamps();
            $table->softDeletes();
            //Foreign Keys
            $table->foreign('category_id')->references('id')->on('item_categories');
            $table->foreign('base_unit_id')->references('id')->on('units');
            $table->foreign('unit_id')->references('id')->on('units');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stock_items');
    }
};

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
        Schema::create('sales_batches', function (Blueprint $table) {
            $table->id();
            $table->string('batch_number');
            $table->unsignedBigInteger('client_id')->nullable();
            $table->string('client_type')->nullable();
            $table->unsignedBigInteger('room_id')->nullable();
            $table->decimal('total_price');
            $table->unsignedInteger('created_by');
            $table->string('source');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sales_batch_id')->constrained();
            $table->string('item_type')->default('stock_item');
            $table->foreignId('store_id')->constrained();
            $table->bigInteger('ref_id');
            $table->string('item_name');
            $table->decimal('unit_price');
            $table->decimal('quantity');
            $table->decimal('total_price');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales_batches');
        Schema::dropIfExists('sales');
    }
};

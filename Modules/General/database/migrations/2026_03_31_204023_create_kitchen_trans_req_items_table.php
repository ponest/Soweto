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
        Schema::create('kitchen_trans_req_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kitchen_trans_req_id')->constrained('kitchen_trans_reqs');
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
        Schema::dropIfExists('kitchen_trans_req_items');
    }
};

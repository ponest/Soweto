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
        Schema::create('menu_price_approval_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('menu_price_approval_id');
            $table->unsignedBigInteger('menu_id');
            $table->decimal('price');
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('menu_price_approval_id')->references('id')->on('menu_price_approvals');
            $table->foreign('menu_id')->references('id')->on('food_menus');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('menu_price_approval_items');
    }
};

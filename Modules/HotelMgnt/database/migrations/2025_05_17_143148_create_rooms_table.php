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
        Schema::create('rooms', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('room_type_id')->unsigned();
            $table->string('room_number');
            $table->string('status')->default('Available');
            $table->integer('rate_per_night')->nullable();
            $table->timestamps();
            $table->softDeletes();
            //Foreign Keys
            $table->foreign('room_type_id')->references('id')->on('room_types');
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rooms');
    }
};

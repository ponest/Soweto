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
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('guest_id')->unsigned();
            $table->bigInteger('room_id')->unsigned();
            $table->dateTime('check_in_date')->nullable();
            $table->dateTime('check_out_date')->nullable();
            $table->string('booking_status');
            $table->integer('price')->nullable();
            $table->bigInteger('created_by')->unsigned();
            $table->timestamps();
            $table->softDeletes();
            //Foreign Key
            $table->foreign('guest_id')->references('id')->on('hotel_guests');
            $table->foreign('room_id')->references('id')->on('rooms');
            $table->foreign('created_by')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('conference_bookings', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('client_id')->unsigned();
            $table->bigInteger('conference_room_id')->unsigned();
            $table->date('start_date');
            $table->date('end_date');
            $table->string('booking_status');
            $table->integer('number_of_people');
            $table->bigInteger('amount_paid');
            $table->float('discount_percentage');
            $table->timestamps();
            $table->softDeletes();
            //Foreign Keys
            $table->foreign('client_id')->references('id')->on('clients');
            $table->foreign('conference_room_id')->references('id')->on('conference_rooms');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('conference_bookings');
    }
};

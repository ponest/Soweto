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
        Schema::create('daily_room_status', function (Blueprint $table) {
            $table->foreignId('room_id')->constrained();
            $table->string('room_number');
            $table->string('room_type');
            $table->bigInteger('rate');
            $table->string('guest')->nullable();
            $table->date('arrival_date')->nullable();
            $table->date('departure_date')->nullable();
            $table->integer('no_of_nights')->nullable();
            $table->integer('pax');
            $table->date('date');
            $table->string('day');
            $table->string('month');
            $table->string('year');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('daily_room_status');
    }
};

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
        Schema::create('room_check_in_outs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('booking_id')->constrained();
            $table->dateTime('checked_in_at');
            $table->dateTime('checked_out_at')->nullable();
            $table->text('remarks')->nullable();
            $table->foreignId('checked_in_by')->constrained('users');
            $table->foreignId('checked_out_by')->nullable()->constrained('users');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('room_check_in_outs');
    }
};

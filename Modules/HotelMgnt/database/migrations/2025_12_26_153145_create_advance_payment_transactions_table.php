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
        Schema::create('advance_payment_transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('advance_payment_id')->constrained();
            $table->foreignId('booking_id')->nullable()->constrained();
            $table->decimal('amount',18);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('advance_payment_transactions');
    }
};

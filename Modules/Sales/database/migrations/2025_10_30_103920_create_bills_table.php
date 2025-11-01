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
        Schema::create('bills', function (Blueprint $table) {
            $table->id();
            $table->foreignId('booking_id')->nullable()->constrained();
            $table->decimal('bill_amount');
            $table->decimal('paid_amount')->default(0);
            $table->decimal('remaining_balance')->default(0);
            $table->string('status')->default('unpaid');
            $table->dateTime('issued_at');
            $table->foreignId('issued_by')->constrained('users');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bills');
    }
};

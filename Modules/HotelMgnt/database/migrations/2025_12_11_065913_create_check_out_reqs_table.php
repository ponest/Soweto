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
        Schema::create('check_out_request', function (Blueprint $table) {
            $table->id();
            $table->string('request_number');
            $table->foreignId('booking_id')->nullable()->constrained('bookings');
            $table->text('description');
            $table->string('status');
            $table->foreignId('submitted_by')->nullable()->constrained('users');
            $table->dateTime('submitted_at')->nullable();
            $table->foreignId('reviewed_by')->nullable()->constrained('users');
            $table->dateTime('reviewed_at')->nullable();
            $table->foreignId('approved_by')->nullable()->constrained('users');
            $table->dateTime('approved_at')->nullable();
            $table->boolean('is_approved')->nullable();
            $table->text('reject_comments')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('check_out_request');
    }
};

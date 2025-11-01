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
        Schema::create('menu_price_approvals', function (Blueprint $table) {
            $table->id();
            $table->text('description');
            $table->string('request_number');
            $table->string('status');
            $table->unsignedBigInteger('submitted_by')->nullable();
            $table->dateTime('submitted_at')->nullable();
            $table->unsignedBigInteger('reviewed_by')->nullable();
            $table->dateTime('reviewed_at')->nullable();
            $table->boolean('is_approved')->nullable();
            $table->text('reject_comments')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('submitted_by')->references('id')->on('users');
            $table->foreign('reviewed_by')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('menu_price_approvals');
    }
};

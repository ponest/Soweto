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
        Schema::create('stock_requisitions', function (Blueprint $table) {
            $table->id();
            $table->string('description');
            $table->string('requisition_number');
            $table->string('status');
            $table->bigInteger('department_id')->nullable()->unsigned();
            $table->dateTime('submitted_at')->nullable();
            $table->bigInteger('submitted_by')->nullable()->unsigned();
            $table->dateTime('reviewed_at')->nullable();
            $table->bigInteger('reviewed_by')->nullable()->unsigned();
            $table->boolean('is_approved')->nullable();
            $table->dateTime('issued_at')->nullable();
            $table->bigInteger('issued_by')->nullable()->unsigned();
            $table->dateTime('received_at')->nullable();
            $table->bigInteger('received_by')->nullable()->unsigned();
            $table->timestamps();
            $table->softDeletes();
            //Foreign Key
            $table->foreign('submitted_by')->references('id')->on('users');
            $table->foreign('reviewed_by')->references('id')->on('users');
            $table->foreign('issued_by')->references('id')->on('users');
            $table->foreign('received_by')->references('id')->on('users');
            $table->foreign('department_id')->references('id')->on('departments');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stock_requisitions');
    }
};

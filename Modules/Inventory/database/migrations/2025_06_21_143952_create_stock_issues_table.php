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
        Schema::create('stock_issue', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('stock_requisition_id');
            $table->string('issue_number');
            $table->string('requisition_number');
            $table->unsignedBigInteger('issued_by');
            $table->dateTime('issued_at');
            $table->unsignedBigInteger('department_id');
            $table->timestamps();
            $table->softDeletes();
            //foreign keys
            $table->foreign('stock_requisition_id')->references('id')->on('stock_requisitions');
            $table->foreign('issued_by')->references('id')->on('users');
            $table->foreign('department_id')->references('id')->on('departments');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stock_issue');
    }
};

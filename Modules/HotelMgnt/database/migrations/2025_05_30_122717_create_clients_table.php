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
//        Schema::create('clients', function (Blueprint $table) {
//            $table->id();
//            $table->unsignedBigInteger('institution_id');
//            $table->string('name');
//            $table->string('email')->unique()->nullable();
//            $table->string('phone_number')->unique();
//            $table->timestamps();
//            $table->softDeletes();
//            //foreign Key
//            $table->foreign('institution_id')->references('id')->on('institutions');
//        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
//        Schema::dropIfExists('clients');
//        conference_bookings_client_id_foreign
    }
};

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
        Schema::create('hotel_guests', function (Blueprint $table) {
            $table->id();
            $table->string('full_name');
            $table->string('gender');
            $table->string('phone_number')->nullable();
            $table->string('email')->nullable();
            $table->bigInteger('identity_type_id')->unsigned()->nullable();
            $table->string('identity_number')->nullable();
            $table->timestamps();
            $table->softDeletes();
            //foreign Key
            $table->foreign('identity_type_id')->references('id')->on('identity_types');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hotel_guests');
    }
};

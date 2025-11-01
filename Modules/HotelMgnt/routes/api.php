<?php

use Illuminate\Support\Facades\Route;
use Modules\HotelMgnt\Http\Controllers\HotelMgntController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('hotelmgnts', HotelMgntController::class)->names('hotelmgnt');
});

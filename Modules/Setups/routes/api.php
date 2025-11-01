<?php

use Illuminate\Support\Facades\Route;
use Modules\Setups\Http\Controllers\SetupsController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('setups', SetupsController::class)->names('setups');
});

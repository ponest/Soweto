<?php

use Illuminate\Support\Facades\Route;
use Modules\General\Http\Controllers\GeneralController;
use Modules\General\Http\Controllers\LogActivitiesController;
use Modules\General\Http\Controllers\StaffsController;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('generals', GeneralController::class)->names('general');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('staffs', StaffsController::class)->except('show', 'destroy');
    Route::get('staffs/destroy/{id}', [StaffsController::class, 'destroy'])->name('staffs.destroy');

    Route::get('logs', [LogActivitiesController::class, 'index'])->name('logs.index');
    Route::get('logs.filtered', [LogActivitiesController::class, 'getFiltered'])->name('logs.filtered');
});

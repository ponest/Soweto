<?php

use Illuminate\Support\Facades\Route;
use Modules\Reports\Http\Controllers\ReportsController;

Route::middleware(['auth', 'verified'])->group(function () {
//    Route::resource('reports', ReportsController::class)->names('reports');
//    Route::get('run-dev', [ReportsController::class,'index'])->name('run-dev');
    Route::get('daily-stock-index', [ReportsController::class,'dailyStockSheetIndex'])->name('daily-stock-index');
    Route::post('daily-stock', [ReportsController::class,'getDailyStockSheet'])->name('daily-stock');
    Route::get('daily-stock-excel', [ReportsController::class,'dailyStockSheetExcel'])->name('daily-stock-excel');
});

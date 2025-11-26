<?php

use Illuminate\Support\Facades\Route;
use Modules\General\Http\Controllers\DiscountReqController;
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

    Route::resource('discount-req', DiscountReqController::class)->except('show', 'destroy');
    Route::get('discount-req/destroy/{id}', [DiscountReqController::class, 'destroy'])->name('discount-req.destroy');
    Route::get('discount-req/submit/{id}', [DiscountReqController::class, 'submitRequest'])->name('discount-req.submit');
    Route::get('discount-req/approve/{id}', [DiscountReqController::class, 'approveRequest'])->name('discount-req.approve');
    Route::get('discount-req/approve-view', [DiscountReqController::class, 'approverView'])->name('discount-req.approve-view');
    Route::get('discount-req/review/{id}', [DiscountReqController::class, 'reviewRequest'])->name('discount-req.review');
    Route::get('discount-req/approved', [DiscountReqController::class, 'approved'])->name('discount-req.approved');
//    Route::get('stock-requisition/items/{id}', [StockRequisitionsController::class, 'viewItems'])->name('stock-requisition.items');
//    Route::get('stock-requisition/reject/{id}', [StockRequisitionsController::class, 'rejectView'])->name('stock-requisition.reject-view');
//    Route::post('stock-requisition/reject', [StockRequisitionsController::class, 'rejectRequest'])->name('stock-requisition.reject');

});

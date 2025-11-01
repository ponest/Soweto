<?php

use Illuminate\Support\Facades\Route;
use Modules\Inventory\Http\Controllers\InventoryController;
use Modules\Inventory\Http\Controllers\ItemStockInController;
use Modules\Inventory\Http\Controllers\ItemUnitConversionController;
use Modules\Inventory\Http\Controllers\StockIssuingController;
use Modules\Inventory\Http\Controllers\StockItemController;
use Modules\Inventory\Http\Controllers\StockRequisitionItemsController;
use Modules\Inventory\Http\Controllers\StockRequisitionsController;
use Modules\Inventory\Http\Controllers\StoreController;
use Modules\Inventory\Http\Controllers\StoreItemController;
use Modules\Inventory\Http\Controllers\SuppliersController;

Route::middleware('auth')->group(function () {
    Route::resource('inventories', InventoryController::class)->names('inventory');

    Route::resource('stores', StoreController::class)->except('show', 'destroy');
    Route::get('stores/destroy/{id}', [StoreController::class, 'destroy'])->name('stores.destroy');

    Route::resource('stock-items', StockItemController::class)->except('show', 'destroy');
    Route::get('stock-items/destroy/{id}', [StockItemController::class, 'destroy'])->name('stock-item.destroy');

    Route::resource('suppliers', SuppliersController::class)->except('show', 'destroy');
    Route::get('suppliers/destroy/{id}', [SuppliersController::class, 'destroy'])->name('suppliers.destroy');

    Route::resource('unit-conversion', ItemUnitConversionController::class)->except('show', 'destroy');
    Route::get('unit-conversion/destroy/{id}', [ItemUnitConversionController::class, 'destroy'])->name('unit-conversion.destroy');

    Route::resource('item-stock-in', ItemStockInController::class)->except('show', 'destroy');
    Route::get('item-stock-in/destroy/{id}', [ItemStockInController::class, 'destroy'])->name('item-stock-in.destroy');

    Route::get('stock-balance', [StoreItemController::class, 'stockBalance'])->name('stock-balance');


    Route::resource('stock-requisition', StockRequisitionsController::class)->except('show', 'destroy');
    Route::get('stock-requisition/destroy/{id}', [StockRequisitionsController::class, 'destroy'])->name('stock-requisition.destroy');
    Route::get('stock-requisition/submit/{id}', [StockRequisitionsController::class, 'submitRequest'])->name('stock-requisition.submit');
    Route::get('stock-requisition/approve/{id}', [StockRequisitionsController::class, 'approveRequest'])->name('stock-requisition.approve');
    Route::get('stock-requisition/approve-view', [StockRequisitionsController::class, 'approverView'])->name('stock-requisition.approve-view');
    Route::get('stock-requisition/items/{id}', [StockRequisitionsController::class, 'viewItems'])->name('stock-requisition.items');
    Route::get('stock-requisition/reject/{id}', [StockRequisitionsController::class, 'rejectView'])->name('stock-requisition.reject-view');
    Route::post('stock-requisition/reject', [StockRequisitionsController::class, 'rejectRequest'])->name('stock-requisition.reject');

    Route::resource('stock-requisition-item', StockRequisitionItemsController::class)->except('show', 'destroy','index');
    Route::get('stock-requisition-item/index/{id}/{type?}', [StockRequisitionItemsController::class, 'index'])->name('stock-requisition-item.index');
    Route::get('stock-requisition-item/destroy/{id}', [StockRequisitionItemsController::class, 'destroy'])->name('stock-requisition-item.destroy');

    Route::get('ajax/get_unit', [StockItemController::class, 'getUnit'])->name('get-unit');

    Route::get('stock-issue/requests', [StockIssuingController::class, 'request'])->name('stock-issue.requests');
    Route::get('stock-issue/confirm/{id}', [StockIssuingController::class, 'confirmItemView'])->name('stock-issue.confirm-view');
    Route::post('stock-issue/confirm', [StockIssuingController::class, 'confirmItem'])->name('stock-issue.confirm');
    Route::get('stock-issue/issue/{id}', [StockIssuingController::class, 'issueStock'])->name('stock-issue.issue');
    Route::get('stock-issue/index', [StockIssuingController::class, 'index'])->name('stock-issue.index');
    Route::get('stock-issue/receive/{id}', [StockIssuingController::class, 'receiveStock'])->name('stock-issue.receive');

});

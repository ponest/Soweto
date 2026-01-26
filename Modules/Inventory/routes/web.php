<?php

use Illuminate\Support\Facades\Route;
use Modules\Inventory\Http\Controllers\DisposalRequestController;
use Modules\Inventory\Http\Controllers\DisposalRequestItemsController;
use Modules\Inventory\Http\Controllers\InventoryController;
use Modules\Inventory\Http\Controllers\ItemStockInController;
use Modules\Inventory\Http\Controllers\ItemUnitConversionController;
use Modules\Inventory\Http\Controllers\PurchaseReqAdditionalCostController;
use Modules\Inventory\Http\Controllers\PurchaseReqItemsController;
use Modules\Inventory\Http\Controllers\PurchaseRequestController;
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
    Route::get('stock-requisition/approved', [StockRequisitionsController::class, 'approved'])->name('stock-requisition.approved');
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

    Route::resource('purchase-request', PurchaseRequestController::class)->except('show', 'destroy');
    Route::get('purchase-request/destroy/{id}', [PurchaseRequestController::class, 'destroy'])->name('purchase-request.destroy');
    Route::get('purchase-request/submit/{id}', [PurchaseRequestController::class, 'submitRequest'])->name('purchase-request.submit');
    Route::get('purchase-request/approve/{id}', [PurchaseRequestController::class, 'approveRequest'])->name('purchase-request.approve');
    Route::get('purchase-request/preview/{id}', [PurchaseRequestController::class, 'previewRequest'])->name('purchase-request.preview');
    Route::get('purchase-request/review/{id}', [PurchaseRequestController::class, 'reviewRequest'])->name('purchase-request.review');
    Route::get('purchase-request/approve-view', [PurchaseRequestController::class, 'approverView'])->name('purchase-request.approve-view');
    Route::get('purchase-request/approved', [PurchaseRequestController::class, 'approved'])->name('purchase-request.approved');
    Route::get('purchase-request/items/{id}', [PurchaseRequestController::class, 'viewItems'])->name('purchase-request.items');
    Route::get('purchase-request/reject/{id}', [PurchaseRequestController::class, 'rejectView'])->name('purchase-request.reject-view');
    Route::post('purchase-request/reject', [PurchaseRequestController::class, 'rejectRequest'])->name('purchase-request.reject');
    Route::get('purchase-request/rejected', [PurchaseRequestController::class, 'rejected'])->name('purchase-request.rejected');


    Route::resource('purchase-request-item', PurchaseReqItemsController::class)->except('show', 'destroy','index');
    Route::get('purchase-request-item/index/{id}', [PurchaseReqItemsController::class, 'index'])->name('purchase-request-item.index');
    Route::get('purchase-request-item/destroy/{id}', [PurchaseReqItemsController::class, 'destroy'])->name('purchase-request-item.destroy');
    Route::get('ajax/get-items', [PurchaseReqItemsController::class, 'getItems'])->name('ajax.get-items');

    Route::resource('purchase-req-cost', PurchaseReqAdditionalCostController::class)->except('show', 'destroy','index');
    Route::get('purchase-req-cost/index/{id}', [PurchaseReqAdditionalCostController::class, 'index'])->name('purchase-req-cost');
    Route::get('purchase-req-cost/destroy/{id}', [PurchaseReqAdditionalCostController::class, 'destroy'])->name('purchase-req-cost.destroy');


    Route::resource('disposal-request', DisposalRequestController::class)->except('show', 'destroy');
    Route::get('disposal-request/destroy/{id}', [DisposalRequestController::class, 'destroy'])->name('disposal-request.destroy');
    Route::get('disposal-request/submit/{id}', [DisposalRequestController::class, 'submitRequest'])->name('disposal-request.submit');
    Route::get('disposal-request/approve/{id}', [DisposalRequestController::class, 'approveRequest'])->name('disposal-request.approve');
    Route::get('disposal-request/review/{id}', [DisposalRequestController::class, 'reviewRequest'])->name('disposal-request.review');
    Route::get('disposal-request/approve-view', [DisposalRequestController::class, 'approverView'])->name('disposal-request.approve-view');
    Route::get('disposal-request/approved', [DisposalRequestController::class, 'approved'])->name('disposal-request.approved');
    Route::get('disposal-request/items/{id}', [DisposalRequestController::class, 'viewItems'])->name('disposal-request.items');
    Route::get('disposal-request/reject/{id}', [DisposalRequestController::class, 'rejectView'])->name('disposal-request.reject-view');
    Route::post('disposal-request/reject', [DisposalRequestController::class, 'rejectRequest'])->name('disposal-request.reject');
    Route::get('disposal-request/rejected', [DisposalRequestController::class, 'rejected'])->name('disposal-request.rejected');


    Route::resource('disposal-request-item', DisposalRequestItemsController::class)->except('show', 'destroy','index');
    Route::get('disposal-request-item/index/{id}', [DisposalRequestItemsController::class, 'index'])->name('disposal-request-item.index');
    Route::get('disposal-request-item/destroy/{id}', [DisposalRequestItemsController::class, 'destroy'])->name('disposal-request-item.destroy');

});

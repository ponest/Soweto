<?php

use Illuminate\Support\Facades\Route;
use Modules\Sales\Http\Controllers\BillsController;
use Modules\Sales\Http\Controllers\ItemPriceController;
use Modules\Sales\Http\Controllers\MenuPriceApprovalController;
use Modules\Sales\Http\Controllers\FoodMenuController;
use Modules\Sales\Http\Controllers\ItemPriceApprovalController;
use Modules\Sales\Http\Controllers\MenuPriceApprovalItemController;
use Modules\Sales\Http\Controllers\MenuPriceController;
use Modules\Sales\Http\Controllers\PriceApprovalItemController;
use Modules\Sales\Http\Controllers\SalesController;

//Route::middleware(['auth', 'verified'])->group(function () {
//    Route::resource('sales', SalesController::class)->names('sales');
//});

Route::middleware('auth')->group(function () {
    Route::resource('item-price-approval', ItemPriceApprovalController::class)->except('show', 'destroy');
    Route::get('item-price-approval/destroy/{id}', [ItemPriceApprovalController::class, 'destroy'])->name('item-price-approval.destroy');
    Route::get('item-price-approval/submit/{id}', [ItemPriceApprovalController::class, 'submitRequest'])->name('item-price-approval.submit');
    Route::get('item-price-approval/approve/{id}', [ItemPriceApprovalController::class, 'approveRequest'])->name('item-price-approval.approve');
    Route::get('item-price-approval/approve-view', [ItemPriceApprovalController::class, 'approverView'])->name('item-price-approval.approve-view');
    Route::get('item-price-approval/approved', [ItemPriceApprovalController::class, 'approved'])->name('item-price-approval.approved');
    Route::get('item-price-approval/items/{id}', [ItemPriceApprovalController::class, 'viewItems'])->name('item-price-approval.items');
    Route::get('item-price-approval/reject/{id}', [ItemPriceApprovalController::class, 'rejectView'])->name('item-price-approval.reject-view');
    Route::post('item-price-approval/reject', [ItemPriceApprovalController::class, 'rejectRequest'])->name('item-price-approval.reject');

    Route::get('item-price/index', [ItemPriceController::class, 'index'])->name('item-price.index');
    Route::get('get-item-price/{id}/{cat}', [ItemPriceController::class, 'getPriceByItem'])->name('item.get-price');
    Route::get('menu-price/index', [MenuPriceController::class, 'index'])->name('menu-price.index');
    Route::get('sales/index/{category}', [SalesController::class, 'index'])->name('sales.index');
    Route::post('sales/item-sale', [SalesController::class, 'itemSales'])->name('sales.item-sales');
    Route::get('sales-history', [SalesController::class, 'salesHistory'])->name('sales-history');

    Route::get('bills/index', [BillsController::class, 'index'])->name('bills.index');
    Route::get('bills/payment-conf/{id}', [BillsController::class, 'confirmPaymentView'])->name('bills.payment-conf');
    Route::post('bills/payment-confirm', [BillsController::class, 'confirmPayment'])->name('bills.payment-confirm');
    Route::get('bills/payment/{id}', [BillsController::class, 'paymentView'])->name('bills.payment');
    Route::get('bills/items/{id}', [BillsController::class, 'billItems'])->name('bills.items');


    Route::resource('price-approval-item', PriceApprovalItemController::class)->except('show', 'destroy','index');
    Route::get('price-approval-item/index/{id}/{type?}', [PriceApprovalItemController::class, 'index'])->name('price-approval-item.index');
    Route::get('price-approval-item/destroy/{id}', [PriceApprovalItemController::class, 'destroy'])->name('price-approval-item.destroy');

    Route::resource('food-menu', FoodMenuController::class)->except('show', 'destroy');
    Route::get('food-menu/destroy/{id}', [FoodMenuController::class, 'destroy'])->name('food-menu.destroy');

    Route::resource('menu-price-approval', MenuPriceApprovalController::class)->except('show', 'destroy');
    Route::get('menu-price-approval/destroy/{id}', [MenuPriceApprovalController::class, 'destroy'])->name('menu-price-approval.destroy');
    Route::get('menu-price-approval/submit/{id}', [MenuPriceApprovalController::class, 'submitRequest'])->name('menu-price-approval.submit');
    Route::get('menu-price-approval/approve/{id}', [MenuPriceApprovalController::class, 'approveRequest'])->name('menu-price-approval.approve');
    Route::get('menu-price-approval/approve-view', [MenuPriceApprovalController::class, 'approverView'])->name('menu-price-approval.approve-view');
    Route::get('menu-price-approval/approved', [MenuPriceApprovalController::class, 'approved'])->name('menu-price-approval.approved');
    Route::get('menu-price-approval/items/{id}', [MenuPriceApprovalController::class, 'viewItems'])->name('menu-price-approval.items');
    Route::get('menu-price-approval/reject/{id}', [MenuPriceApprovalController::class, 'rejectView'])->name('menu-price-approval.reject-view');
    Route::post('menu-price-approval/reject', [MenuPriceApprovalController::class, 'rejectRequest'])->name('menu-price-approval.reject');

    Route::resource('menu-price-approval-item', MenuPriceApprovalItemController::class)->except('show', 'destroy','index');
    Route::get('menu-price-approval-item/index/{id}/{type?}', [MenuPriceApprovalItemController::class, 'index'])->name('menu-price-approval-item.index');
    Route::get('menu-price-approval-item/destroy/{id}', [MenuPriceApprovalItemController::class, 'destroy'])->name('menu-price-approval-item.destroy');
});

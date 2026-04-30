<?php

use Illuminate\Support\Facades\Route;
use Modules\HotelMgnt\Http\Controllers\AdvancePaymentController;
use Modules\HotelMgnt\Http\Controllers\BookingChargesController;
use Modules\HotelMgnt\Http\Controllers\BookingsController;
use Modules\HotelMgnt\Http\Controllers\CheckOutRequestController;
use Modules\HotelMgnt\Http\Controllers\ClientsController;
use Modules\HotelMgnt\Http\Controllers\ClientWalletController;
use Modules\HotelMgnt\Http\Controllers\ConferenceBookingsController;
use Modules\HotelMgnt\Http\Controllers\ConferenceRoomsController;
use Modules\HotelMgnt\Http\Controllers\HotelMgntController;
use Modules\HotelMgnt\Http\Controllers\HouseKeepingLogController;
use Modules\HotelMgnt\Http\Controllers\RoomCheckInOutController;
use Modules\HotelMgnt\Http\Controllers\RoomItemController;
use Modules\HotelMgnt\Http\Controllers\RoomsController;
use Modules\HotelMgnt\Http\Controllers\RoomTypesController;

/*Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('hotelmgnts', HotelMgntController::class)->names('hotelmgnt');
});*/

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('room-types', RoomTypesController::class)->except('show', 'destroy');
    Route::get('room-types/destroy/{id}', [RoomTypesController::class, 'destroy'])->name('room-types.destroy');

    Route::get('rooms/filter/{status}', [RoomsController::class, 'getRoomsByStatus'])->name('rooms.filter.status');
    Route::get('rooms/check-in-out/{type}', [RoomsController::class, 'todayCheckInOut'])->name('rooms.today-check-in-out');
    Route::resource('rooms', RoomsController::class)->except('show', 'destroy');
    Route::get('rooms/destroy/{id}', [RoomsController::class, 'destroy'])->name('rooms.destroy');

    Route::resource('room-items', RoomItemController::class)->except(['show', 'destroy','index']);
    Route::get('room-items/index/{id}', [RoomItemController::class, 'index'])->name('room-items.index');
    Route::get('room-items/destroy/{id}', [RoomItemController::class, 'destroy'])->name('room-items.destroy');



//    Route::resource('guests', ClientsController::class)->except('show', 'destroy');
//    Route::get('guests/destroy/{id}', [ClientsController::class, 'destroy'])->name('guests.destroy');

    Route::resource('house-kp-logs', HouseKeepingLogController::class)->except('show', 'destroy');
    Route::get('house-kp-logs/destroy/{id}', [HouseKeepingLogController::class, 'destroy'])->name('house-kp-logs.destroy');

    Route::resource('bookings', BookingsController::class)->except('show', 'destroy');
    Route::get('bookings/destroy/{id}', [BookingsController::class, 'destroy'])->name('bookings.destroy');
    Route::get('bookings/check-in/{id}', [BookingsController::class, 'checkIn'])->name('bookings.check-in');
    Route::get('bookings/check-out/{id}', [BookingsController::class, 'checkOut'])->name('bookings.check-out');
    Route::get('bookings/cancel/{id}', [BookingsController::class, 'cancelView'])->name('bookings.cancel-view');
    Route::post('bookings/cancel', [BookingsController::class, 'cancelReservation'])->name('bookings.cancel');

    Route::get('room-checkinout', [RoomCheckInOutController::class, 'index'])->name('room-checkinout');
    Route::post('room-check-in', [RoomCheckInOutController::class, 'checkIn'])->name('room-check-in');
    Route::get('room/transfer/{id}', [RoomCheckInOutController::class, 'transferRoomView'])->name('room.transfer-view');
    Route::post('room/transfer', [RoomCheckInOutController::class, 'transferRoom'])->name('room.transfer');
    Route::get('room-check-out/{id}', [RoomCheckInOutController::class, 'checkOut'])->name('room-check-out');
    Route::get('room-compute-bill/{id}', [RoomCheckInOutController::class, 'computeBill'])->name('room-compute-bill');
    Route::get('room/bill/{id}', [RoomCheckInOutController::class, 'downloadBill'])->name('room-download-bill');
    Route::get('room/confirm-payment/{id}', [RoomCheckInOutController::class, 'confirmPaymentView'])->name('room-confirm-payment-view');
    Route::post('room/confirm-payment', [RoomCheckInOutController::class, 'confirmPayment'])->name('room-confirm-payment');

    Route::resource('booking-charges', BookingChargesController::class)->except( 'destroy','index');
    Route::get('booking-charges/index/{id}', [BookingChargesController::class, 'index'])->name('booking-charges.index');
    Route::get('booking-charges/destroy/{id}', [BookingChargesController::class, 'destroy'])->name('booking-charges.destroy');

    Route::resource('clients', ClientsController::class)->except('show', 'destroy');
    Route::get('clients/destroy/{id}', [ClientsController::class, 'destroy'])->name('clients.destroy');

    Route::resource('client-wallet', ClientWalletController::class)->except('show', 'destroy');
    Route::get('client-wallet/destroy/{id}', [ClientWalletController::class, 'destroy'])->name('client-wallet.destroy');
    Route::get('client-wallet/submit/{id}', [ClientWalletController::class, 'submitRequest'])->name('client-wallet.submit');
    Route::get('client-wallet/approver', [ClientWalletController::class, 'approverView'])->name('client-wallet.approver-view');
    Route::get('client-wallet/approve/{id}', [ClientWalletController::class, 'approveRequest'])->name('client-wallet.approve');
    Route::get('client-wallet/approved', [ClientWalletController::class, 'approved'])->name('client-wallet.approved');
    Route::get('client-wallet/details', [ClientWalletController::class, 'getWalletDetails'])->name('client-wallet.details');
    Route::get('client-wallet/reject/{id}', [ClientWalletController::class, 'rejectView'])->name('client-wallet.reject-view');
    Route::post('client-wallet/reject', [ClientWalletController::class, 'rejectRequest'])->name('client-wallet.reject');

    Route::resource('advance-payment', AdvancePaymentController::class)->except('show', 'destroy');
    Route::get('advance-payment/destroy/{id}', [AdvancePaymentController::class, 'destroy'])->name('advance-payment.destroy');
    Route::get('advance-payment/details', [AdvancePaymentController::class, 'getPaymentDetails'])->name('advance-payment.details');


    Route::resource('conference-rooms', ConferenceRoomsController::class)->except('show', 'destroy');
    Route::get('conference-rooms/destroy/{id}', [ConferenceRoomsController::class, 'destroy'])->name('conference-rooms.destroy');

    Route::resource('conference-bookings', ConferenceBookingsController::class)->except('show', 'destroy');
    Route::get('conference-bookings/destroy/{id}', [ConferenceBookingsController::class, 'destroy'])->name('conference-bookings.destroy');
    Route::get('conference-bookings/check-in/{id}', [ConferenceBookingsController::class, 'checkIn'])->name('conference-bookings.check-in');
    Route::get('conference-bookings/check-out/{id}', [ConferenceBookingsController::class, 'checkOut'])->name('conference-bookings.check-out');

    Route::resource('checkout-req', CheckOutRequestController::class)->except('show', 'destroy','create');
    Route::get('checkout-req/create/{id}', [CheckOutRequestController::class, 'create'])->name('checkout-req.create');
    Route::get('checkout-req/destroy/{id}', [CheckOutRequestController::class, 'destroy'])->name('checkout-req.destroy');
    Route::get('checkout-req/submit/{id}', [CheckOutRequestController::class, 'submitRequest'])->name('checkout-req.submit');
    Route::get('checkout-req/approve/{id}', [CheckOutRequestController::class, 'approveRequest'])->name('checkout-req.approve');
    Route::get('checkout-req/approve-view', [CheckOutRequestController::class, 'approverView'])->name('checkout-req.approve-view');
    Route::get('checkout-req/review/{id}', [CheckOutRequestController::class, 'reviewRequest'])->name('checkout-req.review');
    Route::get('checkout-req/approved', [CheckOutRequestController::class, 'approved'])->name('checkout-req.approved');
    Route::get('checkout-req/reject/{id}', [CheckOutRequestController::class, 'rejectView'])->name('checkout-req.reject-view');
    Route::post('checkout-req/reject', [CheckOutRequestController::class, 'rejectRequest'])->name('checkout-req.reject');
    Route::get('checkout-req/rejected', [CheckOutRequestController::class, 'rejected'])->name('checkout-req.rejected');
    Route::get('checkout-req/details', [CheckOutRequestController::class, 'getDiscountDetails'])->name('checkout-req.details');

});

<?php

use Illuminate\Support\Facades\Route;
use Modules\HotelMgnt\Http\Controllers\BookingChargesController;
use Modules\HotelMgnt\Http\Controllers\BookingsController;
use Modules\HotelMgnt\Http\Controllers\ClientsController;
use Modules\HotelMgnt\Http\Controllers\ClientWalletController;
use Modules\HotelMgnt\Http\Controllers\ConferenceBookingsController;
use Modules\HotelMgnt\Http\Controllers\ConferenceRoomsController;
use Modules\HotelMgnt\Http\Controllers\GuestsController;
use Modules\HotelMgnt\Http\Controllers\HotelMgntController;
use Modules\HotelMgnt\Http\Controllers\HouseKeepingLogController;
use Modules\HotelMgnt\Http\Controllers\RoomCheckInOutController;
use Modules\HotelMgnt\Http\Controllers\RoomsController;
use Modules\HotelMgnt\Http\Controllers\RoomTypesController;

/*Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('hotelmgnts', HotelMgntController::class)->names('hotelmgnt');
});*/

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('room-types', RoomTypesController::class)->except('show', 'destroy');
    Route::get('room-types/destroy/{id}', [RoomTypesController::class, 'destroy'])->name('room-types.destroy');

    Route::resource('rooms', RoomsController::class)->except('show', 'destroy');
    Route::get('rooms/destroy/{id}', [RoomsController::class, 'destroy'])->name('rooms.destroy');

    Route::resource('guests', GuestsController::class)->except('show', 'destroy');
    Route::get('guests/destroy/{id}', [GuestsController::class, 'destroy'])->name('guests.destroy');

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

    Route::resource('booking-charges', BookingChargesController::class)->except('show', 'destroy','index');
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

    Route::resource('conference-rooms', ConferenceRoomsController::class)->except('show', 'destroy');
    Route::get('conference-rooms/destroy/{id}', [ConferenceRoomsController::class, 'destroy'])->name('conference-rooms.destroy');

    Route::resource('conference-bookings', ConferenceBookingsController::class)->except('show', 'destroy');
    Route::get('conference-bookings/destroy/{id}', [ConferenceBookingsController::class, 'destroy'])->name('conference-bookings.destroy');
    Route::get('conference-bookings/check-in/{id}', [ConferenceBookingsController::class, 'checkIn'])->name('conference-bookings.check-in');
    Route::get('conference-bookings/check-out/{id}', [ConferenceBookingsController::class, 'checkOut'])->name('conference-bookings.check-out');
});

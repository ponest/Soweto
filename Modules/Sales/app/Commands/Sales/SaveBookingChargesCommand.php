<?php

namespace Modules\Sales\Commands\Sales;

use Modules\HotelMgnt\Models\BookingCharges;

class SaveBookingChargesCommand
{
    public static function handle($item, $category, $booking): void
    {
        $bookingCharges = new BookingCharges();
        $bookingCharges->booking_id = $booking->id;
        $bookingCharges->type = $category == 'bar' ? 'Beverage Charges' : 'Meal Charges';
        $bookingCharges->description = $item['itemName'];
        $bookingCharges->unit_price = $item['price'];
        $bookingCharges->quantity = $item['quantity'];
        $bookingCharges->total_price = $item['total'];
        $bookingCharges->expense_date = date('Y-m-d');
        $bookingCharges->save();
    }
}

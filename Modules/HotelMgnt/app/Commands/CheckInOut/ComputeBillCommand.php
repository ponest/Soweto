<?php

namespace Modules\HotelMgnt\Commands\CheckInOut;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Modules\HotelMgnt\Models\Booking;
use Modules\HotelMgnt\Models\BookingCharges;
use Modules\HotelMgnt\Models\BookingRoomHistory;
use Modules\HotelMgnt\Models\RoomCheckInOut;
use Modules\Sales\Models\Bill;
use Modules\Sales\Models\BillItem;

class ComputeBillCommand
{
    public static function handle($id)
    {
        return DB::transaction(function () use ($id) {
            $roomCheckInOut = RoomCheckInOut::find($id);
            $booking = Booking::with('room')->find($roomCheckInOut->booking_id);
            $bookingHistories = BookingRoomHistory::where([['booking_id', $booking->id],['is_billed',false]])->get();
            $totalRoomCost = 0;

            foreach ($bookingHistories as $stay) {
                Log::info($stay);
                $start_date =  Carbon::parse($stay->start_date);
                $end_date =  Carbon::parse($stay->end_date);
                $days = $stay->end_date
                    ? $start_date->diffInDays($end_date)
                    : $start_date->diffInDays(Carbon::today());

                Log::info($days);
                $totalRoomCost += $days * $stay->rate;
                //Update Status
                $stay->is_billed = true;
                $stay->save();
            }
            Log::info($totalRoomCost);

            $bookingBill = Bill::where('booking_id', $roomCheckInOut->booking_id)->first();
            if (!$bookingBill) {
                $bill = new Bill();
                $bill->booking_id = $roomCheckInOut->booking_id;
                $bill->bill_amount = $totalRoomCost;
                $bill->issued_at = now();
                $bill->issued_by = auth()->id();
                $bill->save();
            }

            if ($totalRoomCost > 0){
                //Save to Room Charges
                $bookingCharges = new BookingCharges();
                $bookingCharges->booking_id = $roomCheckInOut->booking_id;
                $bookingCharges->type = "Room Charges";
                $bookingCharges->description = "Accommodation";
                $bookingCharges->amount = $totalRoomCost;
                $bookingCharges->expense_date = date("Y-m-d");
                $bookingCharges->save();
            }

            $AllBookingCharges = BookingCharges::where([['booking_id', $roomCheckInOut->booking_id],['is_billed',false]])->get();
            $sumPrice = 0;
            foreach ($AllBookingCharges as $item) {
                $billItem = new BillItem();
                $billItem->bill_id = $bookingBill ? $bookingBill->id : $bill->id;
                $billItem->item_name = $item->description;
                $billItem->item_description = $item->description;
                $billItem->unit_price = $item->amount;
                $billItem->quantity = 1;
                $billItem->total_price = $item->amount;
                $billItem->save();
                $sumPrice += $item->amount;

                $item->is_billed = true;
                $item->save();
            }

            $bookingBill = Bill::where('booking_id', $roomCheckInOut->booking_id)->first();
            $bookingBill->bill_amount = $sumPrice;
            $bookingBill->save();

            //Update RoomCheckInOut
            $roomCheckInOut->is_billed = true;
            $roomCheckInOut->billed_by = auth()->id();
            $roomCheckInOut->billed_at = now();
            $roomCheckInOut->save();

            //Sending Notification Back
            return [
                'message' => 'Bill Computed Successfully!',
                'type' => 'success'
            ];
        });
    }
}

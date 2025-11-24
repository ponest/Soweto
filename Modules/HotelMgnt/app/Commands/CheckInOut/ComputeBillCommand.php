<?php

namespace Modules\HotelMgnt\Commands\CheckInOut;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Modules\Auth\Models\User;
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
                $start_date =  Carbon::parse($stay->start_date);
                $end_date =  Carbon::parse($stay->end_date);
                $days = $stay->end_date
                    ? $start_date->diffInDays($end_date)
                    : $start_date->diffInDays(Carbon::today());

                $totalRoomCost += $days * $stay->rate;
                //Update Status
                $stay->is_billed = true;
                $stay->save();

                //Save to booking charges
                $bookingCharges = new BookingCharges();
                $bookingCharges->booking_id = $roomCheckInOut->booking_id;
                $bookingCharges->type = "Room Charges";
                $bookingCharges->description = "Accommodation";
                $bookingCharges->unit_price = $stay->rate;
                $bookingCharges->quantity = $days;
                $bookingCharges->total_price = $days * $stay->rate;
                $bookingCharges->expense_date = date("Y-m-d");
                $bookingCharges->save();
            }

            $bookingBill = Bill::where('booking_id', $roomCheckInOut->booking_id)->first();
            if (!$bookingBill) {
                $departmentId = User::currentUserDepartmentId();
                $bill = new Bill();
                $bill->booking_id = $roomCheckInOut->booking_id;
                $bill->bill_amount = $totalRoomCost;
                $bill->reference_no = "BILL-".now()->timestamp;
                $bill->category = "Accommodation";
                $bill->ref_id = $id;
                $bill->issued_at = now();
                $bill->issued_by = auth()->id();
                $bill->department_id = $departmentId;
                $bill->save();
            }

            $skippedTypes = array('Beverage Charges','Meal Charges');
            $AllBookingCharges = BookingCharges::where([['booking_id', $roomCheckInOut->booking_id],['is_billed',false]])
                ->whereNotIn('type',$skippedTypes)->get();
            foreach ($AllBookingCharges as $item) {
                $billItem = new BillItem();
                $billItem->bill_id = $bookingBill ? $bookingBill->id : $bill->id;
                $billItem->item_name = $item->description;
                $billItem->item_description = $item->description;
                $billItem->unit_price = $item->unit_price;
                $billItem->quantity = $item->quantity;
                $billItem->total_price = $item->total_price;
                $billItem->save();

                $item->is_billed = true;
                $item->save();
            }

            $bookingBill = Bill::where('booking_id', $roomCheckInOut->booking_id)->first();
            $bookingBill->bill_amount = BillItem::where('bill_id', $bookingBill->id)->sum('total_price');
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

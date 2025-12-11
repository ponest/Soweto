<?php

namespace Modules\HotelMgnt\Commands\CheckOutRequest;

use Exception;
use Modules\HotelMgnt\Commands\CheckInOut\CheckOutCommand;
use Modules\HotelMgnt\Models\CheckOutRequest;
use Modules\HotelMgnt\Models\RoomCheckInOut;

class ApproveCommand
{
    public static function handle($id): array
    {
        try {
            $checkOutReq = CheckOutRequest::find($id);
            $checkOutReq->approved_by = auth()->id();
            $checkOutReq->approved_at = now();
            $checkOutReq->is_approved = true;
            $checkOutReq->status = "Approved";
            $checkOutReq->update();

            //Checkout
            $roomCheckInOut = RoomCheckInOut::whereBookingId($checkOutReq->booking_id)->latest('id')->first();
            CheckOutCommand::handle($roomCheckInOut->id);

            //Sending Notification Back
            return [
                'message' => 'Checkout Request Successfully Approved!',
                'type' => 'success'
            ];

        } catch (Exception $ex) {
            return [
                'message' => $ex->getMessage(),
                'type' => 'error'
            ];
        }
    }
}

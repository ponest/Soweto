<?php

namespace Modules\HotelMgnt\Commands\CheckOutRequest;

use Exception;
use Modules\HotelMgnt\Models\CheckOutRequest;

class SubmitCommand
{
    public static function handle($id): array
    {
        try {
            //check if there are items
            $checkOutReq = CheckOutRequest::find($id);
            $checkOutReq->submitted_by = auth()->id();
            $checkOutReq->submitted_at = now();
            $checkOutReq->status = "Submitted";

            //Remove other states
            $checkOutReq->is_approved = null;
            $checkOutReq->reviewed_at = null;
            $checkOutReq->reviewed_by = null;
            $checkOutReq->reject_comments = null;

            $checkOutReq->update();
            //Sending Notification Back
            return [
                'message' => 'Checkout Request Successfully Submitted!',
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

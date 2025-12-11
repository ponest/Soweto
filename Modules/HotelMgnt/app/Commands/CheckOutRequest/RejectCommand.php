<?php

namespace Modules\HotelMgnt\Commands\CheckOutRequest;

use Exception;
use Modules\HotelMgnt\Models\CheckOutRequest;

class RejectCommand
{
    public static function handle($id, $data): array
    {
        try {
            $checkOutReq = CheckOutRequest::find($id);
            $checkOutReq->reviewed_by = auth()->id();
            $checkOutReq->reviewed_at = now();
            $checkOutReq->is_approved = false;
            $checkOutReq->status = "Rejected";
            $checkOutReq->reject_comments = $data['reject_comments'];

            //Undo Submission
            $checkOutReq->submitted_by = null;
            $checkOutReq->submitted_at = null;

            //Update
            $checkOutReq->update();
            //Sending Notification Back
            return [
                'message' => 'Checkout Request Successfully Rejected!',
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

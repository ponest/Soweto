<?php

namespace Modules\General\Commands\DiscountRequest;

use Exception;
use Modules\General\Models\DiscountReq;

class RejectCommand
{
    public static function handle($id, $data): array
    {
        try {
            $discountReq = DiscountReq::find($id);
            $discountReq->reviewed_by = auth()->id();
            $discountReq->reviewed_at = now();
            $discountReq->is_approved = false;
            $discountReq->status = "Rejected";
            $discountReq->reject_comments = $data['reject_comments'];

            //Undo Submission
            $discountReq->submitted_by = null;
            $discountReq->submitted_at = null;

            //Update
            $discountReq->update();
            //Sending Notification Back
            return [
                'message' => 'Discount Request Successfully Rejected!',
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

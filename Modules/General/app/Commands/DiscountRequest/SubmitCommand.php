<?php

namespace Modules\General\Commands\DiscountRequest;

use Exception;
use Modules\General\Models\DiscountReq;

class SubmitCommand
{
    public static function handle($id): array
    {
        try {
            //check if there are items
            $discountReq = DiscountReq::find($id);
            $discountReq->submitted_by = auth()->id();
            $discountReq->submitted_at = now();
            $discountReq->status = "Submitted";

            //Remove other states
            $discountReq->is_approved = null;
            $discountReq->reviewed_at = null;
            $discountReq->reviewed_by = null;
            $discountReq->reject_comments = null;

            $discountReq->update();
            //Sending Notification Back
            return [
                'message' => 'Discount Request Successfully Submitted!',
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

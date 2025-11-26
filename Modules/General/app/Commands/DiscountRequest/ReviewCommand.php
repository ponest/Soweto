<?php

namespace Modules\General\Commands\DiscountRequest;

use Exception;
use Modules\General\Models\DiscountReq;

class ReviewCommand
{
    public static function handle($id): array
    {
        try {
            $discountReq = DiscountReq::find($id);
            $discountReq->reviewed_by = auth()->id();
            $discountReq->reviewed_at = now();
            $discountReq->status = "Reviewed";
            $discountReq->update();
            //Sending Notification Back
            return [
                'message' => 'Discount Request Successfully Reviewed!',
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

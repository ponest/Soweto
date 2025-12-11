<?php

namespace Modules\HotelMgnt\Commands\CheckOutRequest;

use Exception;
use Modules\HotelMgnt\Models\CheckOutRequest;

class ReviewCommand
{
    public static function handle($id): array
    {
        try {
            $discountReq = CheckOutRequest::find($id);
            $discountReq->reviewed_by = auth()->id();
            $discountReq->reviewed_at = now();
            $discountReq->status = "Reviewed";
            $discountReq->update();
            //Sending Notification Back
            return [
                'message' => 'Checkout Request Successfully Reviewed!',
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

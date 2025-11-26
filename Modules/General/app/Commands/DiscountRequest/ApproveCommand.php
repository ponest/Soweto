<?php

namespace Modules\General\Commands\DiscountRequest;

use Exception;
use Illuminate\Support\Str;
use Modules\General\Models\DiscountReq;

class ApproveCommand
{
    public static function handle($id): array
    {
        try {
            $first = strtoupper(Str::random(3));
            $last = strtoupper(Str::random(3));
            $middleNumber = rand(100000, 999999);
            $discountCode = $first . $middleNumber . $last;

            $discountReq = DiscountReq::find($id);
            $discountReq->approved_by = auth()->id();
            $discountReq->approved_at = now();
            $discountReq->is_approved = true;
            $discountReq->status = "Approved";
            $discountReq->discount_code = $discountCode;
            $discountReq->update();
            //Sending Notification Back
            return [
                'message' => 'Discount Request Successfully Approved!',
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

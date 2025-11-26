<?php

namespace Modules\General\Commands\DiscountRequest;

use Exception;
use Modules\General\Models\DiscountReq;

class UpdateCommand
{
    public static function handle($data, $id): array
    {
        try {
            $discountReq = DiscountReq::find($id);
            $discountReq->update($data);
            //Sending Notification Back to Roles
            return [
                'message' => 'Discount Request Successfully Updated',
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

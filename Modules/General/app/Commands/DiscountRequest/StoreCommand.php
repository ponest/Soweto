<?php

namespace Modules\General\Commands\DiscountRequest;

use Exception;
use Modules\General\Models\DiscountReq;

class StoreCommand
{
    public static function handle($data): array
    {
        try {

            $data['request_number'] = 'DISC-' . now()->timestamp;
            $data['status'] = "Draft";
            DiscountReq::create($data);
            //Sending Notification Back
            return [
                'message' => 'Discount Request Successfully Created!',
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

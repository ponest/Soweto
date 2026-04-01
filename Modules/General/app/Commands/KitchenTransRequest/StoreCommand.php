<?php

namespace Modules\General\Commands\KitchenTransRequest;

use Exception;
use Modules\General\Models\KitchenTransReq;

class StoreCommand
{
    public static function handle($data): array
    {
        try {

            $data['request_number'] = 'KTR-' . now()->timestamp;
            $data['status'] = "Draft";
            KitchenTransReq::create($data);
            //Sending Notification Back
            return [
                'message' => 'Kitchen Transaction Request Successfully Created!',
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

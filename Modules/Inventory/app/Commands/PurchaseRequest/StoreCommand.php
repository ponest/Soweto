<?php

namespace Modules\Inventory\Commands\PurchaseRequest;

use Exception;
use Modules\Inventory\Models\PurchaseRequest;

class StoreCommand
{
    public static function handle($data): array
    {
        try {

            $data['request_number'] = 'REQ-' . now()->timestamp;
            $data['status'] = "Draft";
            PurchaseRequest::create($data);
            //Sending Notification Back
            return [
                'message' => 'Purchase  Request Successfully Created!',
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

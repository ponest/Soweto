<?php

namespace Modules\Inventory\Commands\PurchaseRequest;

use Exception;
use Modules\Inventory\Models\PurchaseRequest;

class UpdateCommand
{
    public static function handle($data, $id): array
    {
        try {
            $purchaseRequest = PurchaseRequest::find($id);
            $purchaseRequest->update($data);

            //Sending Notification Back
            return [
                'message' => 'Purchase Request Successfully Updated',
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

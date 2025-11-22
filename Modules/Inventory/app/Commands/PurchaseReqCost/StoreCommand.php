<?php

namespace Modules\Inventory\Commands\PurchaseReqCost;

use Exception;
use Modules\Inventory\Models\PurchaseReqAdditionalCost;

class StoreCommand
{
    public static function handle($data): array
    {
        try {
            $isExist = PurchaseReqAdditionalCost::isExist($data['cost_item'], $data['purchase_request_id']);
            if (!$isExist) {
                PurchaseReqAdditionalCost::create($data);
                //Sending Notification Back
                return [
                    'message' => 'Addition Cost Successfully Created!',
                    'type' => 'success'
                ];
            } else {
                return [
                    'message' => "Item Already Exist!",
                    'type' => 'error'
                ];
            }
        } catch (Exception $ex) {
            return [
                'message' => $ex->getMessage(),
                'type' => 'error'
            ];
        }
    }
}

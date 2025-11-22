<?php

namespace Modules\Inventory\Commands\PurchaseReqCost;

use Exception;
use Modules\Inventory\Models\PurchaseReqAdditionalCost;

class UpdateCommand
{
    public static function handle($data, $id): array
    {
        try {
            $requestItem = PurchaseReqAdditionalCost::find($id);
            $isExist = PurchaseReqAdditionalCost::isExistOnEdit($data['cost_item'], $requestItem->purchase_request_id, $id);
            if (!$isExist) {
                $requestItem->update($data);
                //Sending Notification Back to Roles
                return [
                    'message' => 'Additional Cost Successfully Updated',
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

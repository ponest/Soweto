<?php

namespace Modules\Inventory\Commands\DisposalRequestItem;

use Exception;
use Modules\Inventory\Models\DisposalRequestItem;

class UpdateCommand
{
    public static function handle($data, $id): array
    {
        try {
            $requestItem = DisposalRequestItem::find($id);
            $isExist = DisposalRequestItem::isExistOnEdit($data['stock_item_id'], $requestItem->disposal_request_id, $id);
            if (!$isExist) {
                $requestItem->update($data);
                //Sending Notification Back to Roles
                return [
                    'message' => 'Stock Disposal Request Item Successfully Updated',
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

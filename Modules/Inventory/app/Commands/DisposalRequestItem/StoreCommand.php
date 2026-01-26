<?php

namespace Modules\Inventory\Commands\DisposalRequestItem;

use Exception;
use Modules\Inventory\Models\DisposalRequestItem;

class StoreCommand
{
    public static function handle($data): array
    {
        try {
            $isExist = DisposalRequestItem::isExist($data['stock_item_id'], $data['disposal_request_id']);
            if (!$isExist) {
                DisposalRequestItem::create($data);
                //Sending Notification Back
                return [
                    'message' => 'Disposal Request Item Successfully Created!',
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

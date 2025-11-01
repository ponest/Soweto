<?php

namespace Modules\Sales\Commands\MenuPriceApprovalItem;

use Exception;
use Modules\Sales\Models\MenuPriceApprovalItem;

class StoreCommand
{
    public static function handle($data): array
    {
        try {
            $isExist = MenuPriceApprovalItem::isExist($data['menu_id'], $data['menu_price_approval_id']);
            if (!$isExist) {
                MenuPriceApprovalItem::create($data);
                //Sending Notification Back
                return [
                    'message' => 'Price Approval Item Successfully Created!',
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

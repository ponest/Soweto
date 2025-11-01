<?php

namespace Modules\Sales\Commands\MenuPriceApprovalItem;

use Exception;
use Modules\Sales\Models\MenuPriceApprovalItem;

class UpdateCommand
{
    public static function handle($data, $id): array
    {
        try {
            $priceApprovalItem = MenuPriceApprovalItem::find($id);
            $isExist = MenuPriceApprovalItem::isExistOnEdit($data['menu_id'], $priceApprovalItem->menu_price_approval_id, $id);
            if (!$isExist) {
                $priceApprovalItem->update($data);
                //Sending Notification Back to Roles
                return [
                    'message' => 'Price Approval Item Successfully Updated',
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

<?php

namespace Modules\Inventory\Commands\PurchaseRequestItem;

use Exception;
use Modules\Inventory\Models\ItemUnitConversion;
use Modules\Inventory\Models\PurchaseReqItem;

class StoreCommand
{
    public static function handle($data): array
    {
        try {
            $isExist = PurchaseReqItem::isExist($data['stock_item_id'], $data['purchase_request_id']);
            if (!$isExist) {
                $unit_conversion = ItemUnitConversion::where('item_id', $data['stock_item_id'])->first();
                if ($unit_conversion) {
                    $data['unit_id'] = $unit_conversion->to_unit_id;
                    $data['quantity'] = $data['bulk_quantity'] * $unit_conversion->multiplier;
                }else{
                    $data['unit_id'] = $data['bulk_unit_id'];
                    $data['quantity'] = $data['bulk_quantity'];
                }
                PurchaseReqItem::create($data);
                //Sending Notification Back
                return [
                    'message' => 'Purchase Request Item Successfully Created!',
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

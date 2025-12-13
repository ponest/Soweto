<?php

namespace Modules\Inventory\Commands\ItemStockIn;

use Exception;
use Modules\Auth\Models\User;
use Modules\Inventory\Models\ItemStockIn;
use Modules\Inventory\Models\ItemUnitConversion;
use Modules\Inventory\Models\PurchaseReqItem;
use Modules\Inventory\Models\StoreItem;

class StoreCommand
{
    public static function handle($data): array
    {
        try {
            $item_conversion = ItemUnitConversion::getConversion($data['item_id'], $data['bulk_unit_id']);
            if ($item_conversion) {
                $data['unit_id'] = $item_conversion->to_unit_id;
                $data['quantity'] = $item_conversion->multiplier * $data['bulk_quantity'];
            } else {
                $data['unit_id'] = $data['bulk_unit_id'];
                $data['quantity'] = $data['bulk_quantity'];
            }
            //check if user is assigned to a Store
            $storeId = auth()->user()->store_id;
            if ($storeId) {
                //check if purchase request correspond to the entered things
                $purchaseReItem = PurchaseReqItem::where([['purchase_request_id', $data['purchase_request_id']], ['stock_item_id', $data['item_id']]])->first();
                if ($data['quantity'] > $purchaseReItem->quantity) {
                    return [
                        'message' => "Warning!, The Qty {$data['quantity']} exceeds Purchase Request Qty which was $purchaseReItem->quantity",
                        'type' => 'error'
                    ];
                }

                $purchaseReItem = PurchaseReqItem::where([['purchase_request_id', $data['purchase_request_id']], ['stock_item_id', $data['item_id']]])->first();
                if ($data['total_price'] > $purchaseReItem->total_price) {
                    return [
                        'message' => "Warning!, The total Price {$data['total_price']} exceeds Purchase Request Qty which was $purchaseReItem->total_price",
                        'type' => 'error'
                    ];
                }

                $data['store_id'] = $storeId;
                $data['department_id'] = User::currentUserDepartmentId();
                ItemStockIn::create($data);

                //Save item to store
                $storeItem = StoreItem::where('store_id', $storeId)
                    ->where('item_id', $data['item_id'])->first();
                if (!$storeItem) {
                    $newStoreItem = new StoreItem();
                    $newStoreItem->store_id = $storeId;
                    $newStoreItem->item_id = $data['item_id'];
                    $newStoreItem->save();
                }

                //Sending Notification Back
                return [
                    'message' => 'Item Stock Successfully Created!',
                    'type' => 'success'
                ];
            }else{
                return [
                    'message' => "Failed to Create Item Stock, The Current user is not assigned to any store",
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

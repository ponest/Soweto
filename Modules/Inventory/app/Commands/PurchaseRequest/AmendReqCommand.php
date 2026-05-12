<?php

namespace Modules\Inventory\Commands\PurchaseRequest;

use Exception;
use Illuminate\Support\Facades\DB;
use Modules\Inventory\Models\PurchaseRequest;

class AmendReqCommand
{
    public static function handle($id): array
    {
        DB::beginTransaction();

        try {
            $parent = PurchaseRequest::findOrFail($id);

            $data['request_number'] = 'REQ-' . now()->timestamp;
            $data['status'] = "Draft";
            $data['parent_id'] = $id;
            $data['description'] = $parent->description . " - Amend Request";
            $data['request_type'] = "Amendment";

            $saved = PurchaseRequest::create($data);

            // saving items
//            $purchaseItems = PurchaseReqItem::where('purchase_request_id', $id)->get();

//            foreach ($purchaseItems as $purchaseItem) {
//                $reqItem = new PurchaseReqItem();
//                $reqItem->purchase_request_id = $saved->id;
//                $reqItem->stock_item_id = $purchaseItem->stock_item_id;
//                $reqItem->quantity = $purchaseItem->quantity;
//                $reqItem->unit_price = $purchaseItem->unit_price;
//                $reqItem->unit_id = $purchaseItem->unit_id;
//                $reqItem->total_price = $purchaseItem->total_price;
//                $reqItem->save();
//            }

            DB::commit();

            return [
                'message' => 'Purchase Request Successfully Created!',
                'type' => 'success'
            ];

        } catch (Exception $ex) {

            DB::rollBack();

            return [
                'message' => $ex->getMessage(),
                'type' => 'error'
            ];
        }
    }
}

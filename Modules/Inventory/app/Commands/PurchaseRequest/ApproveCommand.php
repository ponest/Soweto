<?php

namespace Modules\Inventory\Commands\PurchaseRequest;

use Exception;
use Illuminate\Support\Facades\DB;
use Modules\Inventory\Models\PurchaseReqItem;
use Modules\Inventory\Models\PurchaseRequest;
use Throwable;

class ApproveCommand
{
    /**
     * @throws Throwable
     */
    public static function handle($id): array
    {
        DB::beginTransaction();

        try {

            $purchaseRequest = PurchaseRequest::findOrFail($id);

            $purchaseRequest->approved_by = auth()->id();
            $purchaseRequest->approved_at = now();
            $purchaseRequest->is_approved = true;
            $purchaseRequest->status = "Approved";
            $purchaseRequest->save();

            // Check if Is Amended Request
            if ($purchaseRequest->request_type == "Amendment") {

                $parentRequest = PurchaseRequest::findOrFail($purchaseRequest->parent_id);

                $requestItems = PurchaseReqItem::where('purchase_request_id', $purchaseRequest->id)->get();

                foreach ($requestItems as $requestItem) {

                    $parentRequestItem = PurchaseReqItem::where('purchase_request_id', $parentRequest->id)
                        ->where('stock_item_id', $requestItem->stock_item_id)
                        ->first();

                    if ($parentRequestItem) {
                        $parentRequestItem->unit_price = $requestItem->amended_unit_price;
                        $parentRequestItem->total_price = $requestItem->amended_total_price;
                        $parentRequestItem->save();
                    }
                }
            }

            DB::commit();

            return [
                'message' => 'Purchase Request Successfully Approved!',
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

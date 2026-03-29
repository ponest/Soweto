<?php

namespace Modules\General\Commands\StockBacklog;

use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Modules\General\Models\StockBacklogRequest;
use Modules\Inventory\Models\ItemStockIn;
use Modules\Inventory\Models\StoreItem;

class ApproveCommand
{
    public static function handle($id): array
    {
        try {
            DB::beginTransaction();
            $backlogReq = StockBacklogRequest::with('items')->find($id);
            $backlogReq->reviewed_by = auth()->id();
            $backlogReq->reviewed_at = now();
            $backlogReq->is_approved = true;
            $backlogReq->status = "Approved";
            $backlogReq->update();


            foreach ($backlogReq->items as $item) {
                //check if exist in store
                $storeItem = StoreItem::where('store_id', $backlogReq->store_id)->where('item_id', $item->stock_item_id)->first();
                if (!$storeItem) {
                    //Add Items to Store
                    $storeItem = new StoreItem();
                    $storeItem->store_id = $backlogReq->store_id;
                    $storeItem->item_id = $item->stock_item_id;
                    $storeItem->save();
                }

                //Add to Stock
                $stockIn = new ItemStockIn();
                $stockIn->store_id = $backlogReq->store_id;
                $stockIn->item_id = $item->stock_item_id;
                $stockIn->quantity = $item->quantity;
                $stockIn->unit_id = $item->unit_id;
                $stockIn->received_date = date("Y-m-d");
                $stockIn->save();
            }

            DB::commit();

            //Sending Notification Back
            return [
                'message' => 'Stock Backlog Request Successfully Approved!',
                'type' => 'success'
            ];

        } catch (Exception $ex) {
            Log::error($ex->getMessage());
            DB::rollBack();
            return [
                'message' => $ex->getMessage(),
                'type' => 'error'
            ];
        }
    }
}

<?php

namespace Modules\Inventory\Commands\StockIssue;

use Exception;
use Illuminate\Support\Facades\DB;
use Modules\Inventory\Models\ItemStockIn;
use Modules\Inventory\Models\ItemStockOut;
use Modules\Inventory\Models\StockIssue;
use Modules\Inventory\Models\StockIssueItem;
use Modules\Inventory\Models\StockRequisitionItem;
use Modules\Inventory\Models\StoreItem;

class ReceiveStockCommand
{
    public static function handle($id): array
    {
        try {
            //Begin Transaction
            DB::beginTransaction();

            $stockIssue = StockIssue::find($id);

            $stockIssueItems = StockIssueItem::where('stock_issue_id', $id)->get();

            foreach ($stockIssueItems as $stockIssueItem) {
                //Update Stock Issue Item
                $stockIssueItem->is_received = true;
                $stockIssueItem->update();
                //Save to Item Stock in

                //Save to Stock Item Issue
                $itemStockIn = new ItemStockIn();
                $itemStockIn->item_id = $stockIssueItem->item_id;
                $itemStockIn->quantity = $stockIssueItem->quantity;
                $itemStockIn->unit_id = $stockIssueItem->unit_id;
                $itemStockIn->received_date = date('Y-m-d');
                $itemStockIn->department_id = $stockIssueItem->department_id;
                $itemStockIn->store_id = $stockIssueItem->store_id;
                $itemStockIn->save();

                //Save item to store
                $storeItem = StoreItem::where('store_id', $stockIssueItem->store_id)
                    ->where('item_id', $stockIssueItem->item_id)->first();
                if (!$storeItem) {
                    $newStoreItem = new StoreItem();
                    $newStoreItem->store_id = $stockIssueItem->store_id;
                    $newStoreItem->item_id = $stockIssueItem->item_id;
                    $newStoreItem->save();
                }

                //Save Item to Stock Out
                $itemStockOut = new ItemStockOut();
                $itemStockOut->category = "Transfer";
                $itemStockOut->item_id = $stockIssueItem->item_id;
                $itemStockOut->quantity = $stockIssueItem->quantity;
                $itemStockOut->unit_id = $stockIssueItem->unit_id;
                $itemStockOut->store_id = $stockIssueItem->issuing_store_id;
                $itemStockOut->save();

                //Update Requisition Item
                $stockReqItem = StockRequisitionItem::find($stockIssueItem->stock_requisition_item_id);
                $stockReqItem->is_received = true;
                $stockReqItem->update();
            }

            //Update Stock Issue
            $stockIssue->received_by = auth()->id();
            $stockIssue->received_at = now();
            $stockIssue->update();

            // Commit the transaction
            DB::commit();

            return [
                'message' => 'Stock Items Successfully Received!',
                'type' => 'success'
            ];
        } catch (Exception $exception) {
            //RollBack Changes
            DB::rollBack();
            return [
                'message' => $exception->getMessage(),
                'type' => 'error'
            ];
        }
    }
}


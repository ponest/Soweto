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
//    public static function handle($id): array
//    {
//        try {
//            //Begin Transaction
//            DB::beginTransaction();
//
//            $stockIssue = StockIssue::find($id);
//
//            $stockIssueItems = StockIssueItem::where('stock_issue_id', $id)->get();
//
//            foreach ($stockIssueItems as $stockIssueItem) {
//                //Update Stock Issue Item
//                $stockIssueItem->is_received = true;
//                $stockIssueItem->update();
//                //Save to Item Stock in
//
//                //Save to Stock Item Issue
//                $itemStockIn = new ItemStockIn();
//                $itemStockIn->item_id = $stockIssueItem->item_id;
//                $itemStockIn->quantity = $stockIssueItem->quantity;
//                $itemStockIn->unit_id = $stockIssueItem->unit_id;
//                $itemStockIn->received_date = date('Y-m-d');
//                $itemStockIn->department_id = $stockIssueItem->department_id;
//                $itemStockIn->store_id = $stockIssueItem->store_id;
//                $itemStockIn->save();
//
//                //Save item to store
//                $storeItem = StoreItem::where('store_id', $stockIssueItem->store_id)
//                    ->where('item_id', $stockIssueItem->item_id)->first();
//                if (!$storeItem) {
//                    $newStoreItem = new StoreItem();
//                    $newStoreItem->store_id = $stockIssueItem->store_id;
//                    $newStoreItem->item_id = $stockIssueItem->item_id;
//                    $newStoreItem->save();
//                }
//
//                //Save Item to Stock Out
//                $itemStockOut = new ItemStockOut();
//                $itemStockOut->category = "Transfer";
//                $itemStockOut->item_id = $stockIssueItem->item_id;
//                $itemStockOut->quantity = $stockIssueItem->quantity;
//                $itemStockOut->unit_id = $stockIssueItem->unit_id;
//                $itemStockOut->store_id = $stockIssueItem->issuing_store_id;
//                $itemStockOut->save();
//
//                //Update Requisition Item
//                $stockReqItem = StockRequisitionItem::find($stockIssueItem->stock_requisition_item_id);
//                $stockReqItem->is_received = true;
//                $stockReqItem->update();
//            }
//
//            //Update Stock Issue
//            $stockIssue->received_by = auth()->id();
//            $stockIssue->received_at = now();
//            $stockIssue->update();
//
//            // Commit the transaction
//            DB::commit();
//
//            return [
//                'message' => 'Stock Items Successfully Received!',
//                'type' => 'success'
//            ];
//        } catch (Exception $exception) {
//            //RollBack Changes
//            DB::rollBack();
//            return [
//                'message' => $exception->getMessage(),
//                'type' => 'error'
//            ];
//        }
//    }

    public static function handle($id): array
    {
        try {
            DB::beginTransaction();

            // 🔒 Lock the stock issue row (prevents race conditions)
            $stockIssue = StockIssue::where('id', $id)->lockForUpdate()->first();

            if (!$stockIssue) {
                throw new Exception("Stock Issue not found");
            }

            // ✅ Prevent re-processing
            if ($stockIssue->received_at !== null) {
                return [
                    'message' => 'Stock Items already received!',
                    'type' => 'warning'
                ];
            }

            // 🔒 Lock items as well
            $stockIssueItems = StockIssueItem::where('stock_issue_id', $id)
                ->lockForUpdate()
                ->get();

            foreach ($stockIssueItems as $stockIssueItem) {

                // ✅ Skip already processed items
                if ($stockIssueItem->is_received) {
                    continue;
                }

                // -------------------------------
                // Update Stock Issue Item
                // -------------------------------
                $stockIssueItem->is_received = true;
                $stockIssueItem->update();

                // -------------------------------
                // Prevent duplicate StockIn
                // -------------------------------
                $stockInExists = ItemStockIn::where('item_id', $stockIssueItem->item_id)
                    ->where('store_id', $stockIssueItem->store_id)
                    ->where('quantity', $stockIssueItem->quantity)
                    ->whereDate('received_date', date('Y-m-d'))
                    ->exists();

                if (!$stockInExists) {
                    $itemStockIn = new ItemStockIn();
                    $itemStockIn->item_id = $stockIssueItem->item_id;
                    $itemStockIn->quantity = $stockIssueItem->quantity;
                    $itemStockIn->unit_id = $stockIssueItem->unit_id;
                    $itemStockIn->received_date = date('Y-m-d');
                    $itemStockIn->department_id = $stockIssueItem->department_id;
                    $itemStockIn->store_id = $stockIssueItem->store_id;
                    $itemStockIn->save();
                }

                // -------------------------------
                // Ensure Store Item exists
                // -------------------------------
                $storeItem = StoreItem::where('store_id', $stockIssueItem->store_id)
                    ->where('item_id', $stockIssueItem->item_id)
                    ->first();

                if (!$storeItem) {
                    $newStoreItem = new StoreItem();
                    $newStoreItem->store_id = $stockIssueItem->store_id;
                    $newStoreItem->item_id = $stockIssueItem->item_id;
                    $newStoreItem->save();
                }

                // -------------------------------
                // Prevent duplicate StockOut
                // -------------------------------
                $stockOutExists = ItemStockOut::where('item_id', $stockIssueItem->item_id)
                    ->where('store_id', $stockIssueItem->issuing_store_id)
                    ->where('quantity', $stockIssueItem->quantity)
                    ->where('category', 'Transfer')
                    ->exists();

                if (!$stockOutExists) {
                    $itemStockOut = new ItemStockOut();
                    $itemStockOut->category = "Transfer";
                    $itemStockOut->item_id = $stockIssueItem->item_id;
                    $itemStockOut->quantity = $stockIssueItem->quantity;
                    $itemStockOut->unit_id = $stockIssueItem->unit_id;
                    $itemStockOut->store_id = $stockIssueItem->issuing_store_id;
                    $itemStockOut->save();
                }

                // -------------------------------
                // Update Requisition Item
                // -------------------------------
                $stockReqItem = StockRequisitionItem::find($stockIssueItem->stock_requisition_item_id);

                if ($stockReqItem && !$stockReqItem->is_received) {
                    $stockReqItem->is_received = true;
                    $stockReqItem->update();
                }
            }

            // -------------------------------
            // Update Stock Issue
            // -------------------------------
            $stockIssue->received_by = auth()->id();
            $stockIssue->received_at = now();
            $stockIssue->update();

            DB::commit();

            return [
                'message' => 'Stock Items Successfully Received!',
                'type' => 'success'
            ];

        } catch (Exception $exception) {
            DB::rollBack();

            return [
                'message' => $exception->getMessage(),
                'type' => 'error'
            ];
        }
    }
}


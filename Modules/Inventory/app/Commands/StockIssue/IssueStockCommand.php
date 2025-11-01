<?php

namespace Modules\Inventory\Commands\StockIssue;

use Exception;
use Illuminate\Support\Facades\DB;
use Modules\Auth\Models\User;
use Modules\Inventory\Models\StockIssue;
use Modules\Inventory\Models\StockIssueItem;
use Modules\Inventory\Models\StockRequisition;
use Modules\Inventory\Models\StockRequisitionItem;

class IssueStockCommand
{
    public static function handle($id): array
    {
        try {
            //Begin Transaction
            DB::beginTransaction();
            $RequisitionItemsCount = StockRequisitionItem::where('stock_requisition_id', $id)->count();
            $confirmedItemsCount = StockRequisitionItem::where('stock_requisition_id', $id)
                ->where('is_issued',true)->count();


            if ($confirmedItemsCount != $RequisitionItemsCount) {
                //RollBack Changes
                DB::rollBack();
                return [
                    'message' => "You Cannot Issue, Some Items are not confirmed.",
                    'type' => 'error'
                ];
            }else{
                $stockRequisition = StockRequisition::find($id);

                //Save to Stock Issue
                $stockIssue = new StockIssue();
                $stockIssue->stock_requisition_id = $id;
                $stockIssue->issue_number = "ISS-" . rand(100000, 999999);
                $stockIssue->requisition_number = $stockRequisition->requisition_number;
                $stockIssue->issued_by = auth()->id();
                $stockIssue->issued_at = now();
                $stockIssue->department_id = $stockRequisition->department_id;
                $stockIssue->store_id = $stockRequisition->store_id;
                $stockIssue->save();

                $stockRequisitionItems = StockRequisitionItem::where('stock_requisition_id', $id)->get();

                foreach ($stockRequisitionItems as $stockRequisitionItem) {
                    //Save to Stock Item Issue
                    $stockIssueItem = new StockIssueItem();
                    $stockIssueItem->item_id = $stockRequisitionItem->stock_item_id;
                    $stockIssueItem->stock_issue_id = $stockIssue->id;
                    $stockIssueItem->requisition_number = $stockRequisition->requisition_number;
                    $stockIssueItem->quantity = $stockRequisitionItem->issued_quantity;
                    $stockIssueItem->unit_id = $stockRequisitionItem->unit_id;
                    $stockIssueItem->issued_at = now();
                    $stockIssueItem->stock_requisition_item_id = $stockRequisitionItem->id;
                    $stockIssueItem->department_id = $stockRequisition->department_id;
                    $stockIssueItem->store_id = $stockRequisition->store_id;
                    $stockIssueItem->issuing_store_id = User::userStoreId();
                    $stockIssueItem->save();
                }

                //Update Stock Requisition
                $stockRequisition->issued_by = auth()->id();
                $stockRequisition->issued_at = now();
                $stockRequisition->update();

                // Commit the transaction
                DB::commit();

                return [
                    'message' => 'Stock Items Successfully Issued!',
                    'type' => 'success'
                ];
            }
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


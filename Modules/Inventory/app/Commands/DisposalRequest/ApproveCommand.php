<?php

namespace Modules\Inventory\Commands\DisposalRequest;

use Exception;
use Illuminate\Support\Facades\DB;
use Modules\Inventory\Models\DisposalRequest;
use Modules\Inventory\Models\DisposalRequestItem;
use Modules\Inventory\Models\ItemStockOut;

class ApproveCommand
{
    public static function handle($id): array
    {
        try {
            DB::beginTransaction();

            $disposalRequest = DisposalRequest::find($id);
            $disposalRequest->approved_by = auth()->id();
            $disposalRequest->approved_at = now();
            $disposalRequest->is_approved = true;
            $disposalRequest->status = "Approved";
            $disposalRequest->update();

            //Save Data to Stock Out
            $disposalRequestItems = DisposalRequestItem::whereDisposalRequestId($id)->get();
            foreach ($disposalRequestItems as $disposalRequestItem) {
                $stockOut = new ItemStockOut();
                $stockOut->category = "Disposal";
                $stockOut->item_id = $disposalRequestItem->stock_item_id;
                $stockOut->quantity = $disposalRequestItem->quantity;
                $stockOut->unit_id = $disposalRequestItem->unit_id;
                $stockOut->store_id = $disposalRequestItem->store_id;
                $stockOut->save();
            }

            DB::commit();
            //Sending Notification Back
            return [
                'message' => 'Disposal Request Successfully Approved!',
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

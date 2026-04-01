<?php

namespace Modules\General\Commands\KitchenTransRequest;

use App\Enums\GeneralEnum;
use App\Enums\StockOutCategories;
use Exception;
use Modules\General\Models\KitchenTransReq;
use Modules\General\Models\KitchenTransReqItem;
use Modules\Sales\Commands\Sales\SaveStockOutCommand;

class ApproveCommand
{
    public static function handle($id): array
    {
        try {
            $kitchenReq = KitchenTransReq::find($id);
            $kitchenReq->reviewed_by = auth()->id();
            $kitchenReq->reviewed_at = now();
            $kitchenReq->is_approved = true;
            $kitchenReq->status = "Approved";
            $kitchenReq->update();

            //Save to StockOut
            $kitchenItems = KitchenTransReqItem::where('kitchen_trans_req_id', $id)->get();
            foreach ($kitchenItems as $kitchenItem) {
                $itemData['itemId'] = $kitchenItem->stock_item_id;
                $itemData['quantity'] = $kitchenItem->quantity;
                $itemData['unitId'] = $kitchenItem->unit_id;
                $storeId = GeneralEnum::KitchenStoreId;
                SaveStockOutCommand::handle($itemData, $storeId, StockOutCategories::KITCHEN_CONSUMPTION);
            }

            //Sending Notification Back
            return [
                'message' => 'Kitchen Transaction Request Successfully Approved!',
                'type' => 'success'
            ];

        } catch (Exception $ex) {
            return [
                'message' => $ex->getMessage(),
                'type' => 'error'
            ];
        }
    }
}

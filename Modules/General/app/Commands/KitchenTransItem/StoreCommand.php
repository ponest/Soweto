<?php

namespace Modules\General\Commands\KitchenTransItem;

use App\Enums\GeneralEnum;
use Exception;
use Illuminate\Support\Facades\Log;
use Modules\General\Models\KitchenTransReqItem;
use Modules\Inventory\Models\StoreItem;

class StoreCommand
{
    public static function handle($data): array
    {
        try {
            $isExist = KitchenTransReqItem::isExist($data['stock_item_id'], $data['kitchen_trans_req_id']);
            if (!$isExist) {
                //Check if Balance is Enough
                $balance = StoreItem::stockBalance(GeneralEnum::KitchenStoreId,$data['stock_item_id']);

                Log::alert("Balance",$balance);
                if ($balance['balance'] < $data['quantity']) {
                    return [
                        'message' => 'Insufficient Balance for the requested quantity.',
                        'type' => 'error'
                    ];
                }

                KitchenTransReqItem::create($data);
                //Sending Notification Back
                return [
                    'message' => 'Kitchen Transaction Item Successfully Created!',
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

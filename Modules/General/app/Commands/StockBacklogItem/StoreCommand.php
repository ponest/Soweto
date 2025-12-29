<?php

namespace Modules\General\Commands\StockBacklogItem;

use Exception;
use Modules\General\Models\StockBacklogItem;

class StoreCommand
{
    public static function handle($data): array
    {
        try {
            $isExist = StockBacklogItem::isExist($data['stock_item_id'], $data['backlog_request_id']);
            if (!$isExist) {
                StockBacklogItem::create($data);
                //Sending Notification Back
                return [
                    'message' => 'Stock Backlog Item Successfully Created!',
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

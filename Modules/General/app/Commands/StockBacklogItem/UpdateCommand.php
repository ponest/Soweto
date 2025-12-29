<?php

namespace Modules\General\Commands\StockBacklogItem;

use Exception;
use Modules\General\Models\StockBacklogItem;

class UpdateCommand
{
    public static function handle($data, $id): array
    {
        try {
            $backLogItem = StockBacklogItem::find($id);
            $isExist = StockBacklogItem::isExistOnEdit($data['stock_item_id'], $backLogItem->backlog_request_id, $id);
            if (!$isExist) {
                $backLogItem->update($data);
                //Sending Notification Back to Roles
                return [
                    'message' => 'Stock Backlog Item Successfully Updated',
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

<?php

namespace Modules\General\Commands\StockBacklogItem;

use Exception;
use Illuminate\Support\Facades\Log;
use Modules\General\Models\StockBacklogItem;

class DeleteCommand
{
    public static function handle($id): array
    {
        try {
            $item = StockBacklogItem::find($id);
            $item->delete();

            //Sending Back Notification
            return [
                'message' => 'Stock Backlog Item Successfully Deleted!',
                'type' => 'success'
            ];
        } catch (Exception $ex) {
            Log::error($ex->getMessage());
            return [
                'message' => 'Sorry An Error Occurred!',
                'type' => 'error'
            ];
        }
    }
}

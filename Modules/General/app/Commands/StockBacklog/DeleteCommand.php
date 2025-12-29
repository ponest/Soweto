<?php

namespace Modules\General\Commands\StockBacklog;

use Exception;
use Illuminate\Support\Facades\Log;
use Modules\General\Models\StockBacklogRequest;

class DeleteCommand
{
    public static function handle($id): array
    {
        try {
            $item = StockBacklogRequest::find($id);
            $item->items()->delete();
            $item->delete();

            //Sending Back Notification
            return [
                'message' => 'Stock Backlog Request Successfully Deleted!',
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

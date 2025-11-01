<?php

namespace Modules\Inventory\Commands\Store;

use Exception;
use Illuminate\Support\Facades\Log;
use Modules\Inventory\Models\Store;

class DeleteCommand
{
    public static function handle($id): array
    {
        try {
            $item = Store::find($id);
            $item->delete();

            //Sending Back Notification
            return [
                'message' => 'Store Successfully Deleted!',
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

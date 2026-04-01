<?php

namespace Modules\General\Commands\KitchenTransItem;

use Exception;
use Illuminate\Support\Facades\Log;
use Modules\General\Models\KitchenTransReqItem;

class DeleteCommand
{
    public static function handle($id): array
    {
        try {
            $item = KitchenTransReqItem::find($id);
            $item->delete();

            //Sending Back Notification
            return [
                'message' => 'Kitchen Transaction Item Successfully Deleted!',
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

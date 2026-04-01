<?php

namespace Modules\General\Commands\KitchenTransRequest;

use Exception;
use Illuminate\Support\Facades\Log;
use Modules\General\Models\KitchenTransReq;

class DeleteCommand
{
    public static function handle($id): array
    {
        try {
            $item = KitchenTransReq::find($id);
            $item->delete();

            //Sending Back Notification
            return [
                'message' => 'Kitchen Transaction Request Successfully Deleted!',
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

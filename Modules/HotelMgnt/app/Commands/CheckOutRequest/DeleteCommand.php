<?php

namespace Modules\HotelMgnt\Commands\CheckOutRequest;

use Exception;
use Illuminate\Support\Facades\Log;
use Modules\HotelMgnt\Models\CheckOutRequest;

class DeleteCommand
{
    public static function handle($id): array
    {
        try {
            $item = CheckOutRequest::find($id);
            $item->delete();

            //Sending Back Notification
            return [
                'message' => 'Checkout Request Successfully Deleted!',
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

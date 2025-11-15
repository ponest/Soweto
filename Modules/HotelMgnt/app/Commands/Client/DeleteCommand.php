<?php

namespace Modules\HotelMgnt\Commands\Client;

use Exception;
use Illuminate\Support\Facades\Log;
use Modules\HotelMgnt\Models\Client;

class DeleteCommand
{
    public static function handle($id): array
    {
        try {
            $item = Client::find($id);
            $item->delete();

            //Sending Back Notification
            return [
                'message' => 'Guest Successfully Deleted!',
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

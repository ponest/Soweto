<?php

namespace Modules\HotelMgnt\Commands\ClientWallet;

use Exception;
use Illuminate\Support\Facades\Log;
use Modules\HotelMgnt\Models\ClientWallet;

class DeleteCommand
{
    public static function handle($id): array
    {
        try {
            $item = ClientWallet::find($id);
            $item->delete();

            //Sending Back Notification
            return [
                'message' => 'Client Wallet Successfully Deleted!',
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

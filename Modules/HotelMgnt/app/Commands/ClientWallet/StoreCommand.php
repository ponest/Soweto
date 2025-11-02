<?php

namespace Modules\HotelMgnt\Commands\ClientWallet;

use Exception;
use Modules\HotelMgnt\Models\ClientWallet;

class StoreCommand
{
    public static function handle($data): array
    {
        try {
            $data['reference_no'] = "WL-".now()->timestamp;
            ClientWallet::create($data);
            //Sending Notification Back
            return [
                'message' => 'Client Wallet Successfully Created!',
                'type' => 'success'
            ];
        } catch (Exception $exception) {
            return [
                'message' => $exception->getMessage(),
                'type' => 'error'
            ];
        }
    }
}

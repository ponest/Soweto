<?php

namespace Modules\HotelMgnt\Commands\ClientWallet;
use Exception;
use Modules\HotelMgnt\Models\ClientWallet;

class UpdateCommand
{
    public static function handle($data, $id): array
    {
        try {
            $clientWallet = ClientWallet::find($id);
            $clientWallet->update($data);
            //Sending Notification Back to Roles
            return [
                'message' => 'Client Wallet Successfully Updated',
                'type' => 'success'
            ];
        }catch (Exception $exception){
            return [
                'message' => $exception->getMessage(),
                'type' => 'error'
            ];
        }
    }
}

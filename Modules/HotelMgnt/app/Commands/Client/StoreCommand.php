<?php

namespace Modules\HotelMgnt\Commands\Client;

use Exception;
use Illuminate\Support\Facades\Log;
use Modules\HotelMgnt\Models\Client;

class StoreCommand
{
    public static function handle($data): array
    {
        try {
            $is_exist = Client::isExist($data['name'], $data['phone_number']);
            if (!$is_exist) {
                Client::create($data);
                //Sending Notification Back
                return [
                    'message' => 'Client Successfully Created!',
                    'type' => 'success'
                ];
            } else {
                return [
                    'message' => "Client {$data['name']} with phone number {$data['phone_number']} Already Exist!",
                    'type' => 'error'
                ];
            }
        } catch (Exception $ex) {
            Log::error($ex->getMessage());
            return [
                'message' => $ex->getMessage(),
                'type' => 'error'
            ];
        }
    }
}

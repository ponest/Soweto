<?php

namespace Modules\HotelMgnt\Commands\Client;
use Modules\HotelMgnt\Models\Client;

class StoreCommand
{
    public static function handle($data): array
    {
        $is_exist = Client::isExist($data['full_name'], $data['phone_number']);
        if (!$is_exist) {
            Client::create($data);
            //Sending Notification Back
            return [
                'message' => 'Guest Successfully Created!',
                'type' => 'success'
            ];
        } else {
            return [
                'message' => "Guest {$data['name']} with phone number {$data['phone_number']} Already Exist!",
                'type' => 'error'
            ];
        }
    }
}

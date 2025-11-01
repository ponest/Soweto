<?php

namespace Modules\HotelMgnt\Commands\Guest;
use Modules\HotelMgnt\Models\Guest;

class StoreCommand
{
    public static function handle($data): array
    {
        $is_exist = Guest::isExist($data['full_name'], $data['phone_number']);
        if (!$is_exist) {
            Guest::create($data);
            //Sending Notification Back
            return [
                'message' => 'Guest Successfully Created!',
                'type' => 'success'
            ];
        } else {
            return [
                'message' => "Guest {$data['full_name']} with phone number {$data['phone_number']} Already Exist!",
                'type' => 'error'
            ];
        }
    }
}

<?php

namespace Modules\HotelMgnt\Commands\Client;

use Modules\HotelMgnt\Models\Client;

class UpdateCommand
{
    public static function handle($data, $id): array
    {
        $guest = Client::find($id);
        $isExist = Client::isExistOnEdit($data['full_name'], $data['phone_number'], $id);
        if (!$isExist) {
            $guest->update($data);
            //Sending Notification Back to Roles
            return [
                'message' => 'Guest Successfully Updated',
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

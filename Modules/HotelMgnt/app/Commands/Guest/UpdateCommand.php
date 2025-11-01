<?php

namespace Modules\HotelMgnt\Commands\Guest;

use Modules\HotelMgnt\Models\Guest;

class UpdateCommand
{
    public static function handle($data, $id): array
    {
        $guest = Guest::find($id);
        $isExist = Guest::isExistOnEdit($data['full_name'], $data['phone_number'], $id);
        if (!$isExist) {
            $guest->update($data);
            //Sending Notification Back to Roles
            return [
                'message' => 'Guest Successfully Updated',
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

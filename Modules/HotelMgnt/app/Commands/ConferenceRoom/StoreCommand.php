<?php

namespace Modules\HotelMgnt\Commands\ConferenceRoom;

use Exception;
use Modules\HotelMgnt\Models\ConferenceRoom;

class StoreCommand
{
    public static function handle($data): array
    {
        try {
            $is_exist = ConferenceRoom::isExist($data['name']);
            if (!$is_exist) {
                ConferenceRoom::create($data);
                //Sending Notification Back
                return [
                    'message' => 'Conference Room Successfully Created!',
                    'type' => 'success'
                ];
            } else {
                return [
                    'message' => "Conference Room {$data['name']} Already Exist!",
                    'type' => 'error'
                ];
            }
        } catch (Exception $ex) {
            return [
                'message' => $ex->getMessage(),
                'type' => 'error'
            ];
        }
    }
}

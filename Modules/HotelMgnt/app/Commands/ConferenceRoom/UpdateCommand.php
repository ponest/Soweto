<?php

namespace Modules\HotelMgnt\Commands\ConferenceRoom;

use Exception;
use Modules\HotelMgnt\Models\ConferenceRoom;

class UpdateCommand
{
    public static function handle($data, $id): array
    {
        try {
            $conferenceRoom = ConferenceRoom::find($id);
            $isExist = ConferenceRoom::isExistOnEdit($data['name'], $id);
            if (!$isExist) {
                $conferenceRoom->update($data);
                //Sending Notification Back to Roles
                return [
                    'message' => 'Conference Room Successfully Updated',
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

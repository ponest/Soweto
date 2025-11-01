<?php

namespace Modules\General\Commands\Staff;
use Modules\General\Models\Staff;

class StoreCommand
{
    public static function handle($data): array
    {
        $isExist = Staff::isExist($data['first_name'],$data['last_name'],$data['phone_number']);
        if (!$isExist) {
            Staff::create($data);
            //Sending Notification Back
            return [
                'message' => 'Staff Successfully Created!',
                'type' => 'success'
            ];
        } else {
            return [
                'message' => "Staff {$data['first_name']} Already Exist!",
                'type' => 'error'
            ];
        }
    }
}

<?php

namespace Modules\Setups\Commands\StaffRole;
use Modules\Setups\Models\StaffRole;

class StoreCommand
{
    public static function handle($data): array
    {
        $isExist = StaffRole::isExist($data['name']);
        if (!$isExist) {
            StaffRole::create($data);
            //Sending Notification Back
            return [
                'message' => 'Staff Role Successfully Created!',
                'type' => 'success'
            ];
        } else {
            return [
                'message' => "Staff Role {$data['name']} Already Exist!",
                'type' => 'error'
            ];
        }
    }
}

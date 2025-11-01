<?php

namespace Modules\Setups\Commands\StaffRole;
use Modules\Setups\Models\StaffRole;

class UpdateCommand
{
    public static function handle($data, $id): array
    {
        $staffRole = StaffRole::find($id);
        $isExist = StaffRole::isExistOnEdit($data['name'], $id);
        if (!$isExist) {
            $staffRole->update($data);
            //Sending Notification Back to Roles
            return [
                'message' => 'Staff Role Successfully Updated',
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

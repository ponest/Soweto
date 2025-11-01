<?php

namespace Modules\General\Commands\Staff;

use Modules\General\Models\Staff;

class UpdateCommand
{
    public static function handle($data, $id): array
    {
        $staff = Staff::find($id);
        $isExist = Staff::isExistOnEdit($data['first_name'],$data['last_name'],$data['phone_number'], $id);
        if (!$isExist) {
            $staff->update($data);
            //Sending Notification Back to Roles
            return [
                'message' => 'Staff Successfully Updated',
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

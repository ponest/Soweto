<?php

namespace Modules\Setups\Commands\Department;
use Modules\Setups\Models\Department;

class UpdateCommand
{
    public static function handle($data, $id): array
    {
        $identityType = Department::find($id);
        $isExist = Department::isExistOnEdit($data['name'], $id);
        if (!$isExist) {
            $identityType->update($data);
            //Sending Notification Back to Roles
            return [
                'message' => 'Department Successfully Updated',
                'type' => 'success'
            ];
        } else {
            return [
                'message' => "Department {$data['name']} Already Exist!",
                'type' => 'error'
            ];
        }
    }
}

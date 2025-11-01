<?php

namespace Modules\Setups\Commands\Department;
use Modules\Setups\Models\Department;

class StoreCommand
{
    public static function handle($data): array
    {
        $isExist = Department::isExist($data['name']);
        if (!$isExist) {
            Department::create($data);
            //Sending Notification Back
            return [
                'message' => 'Department Successfully Created!',
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

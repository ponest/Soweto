<?php

namespace Modules\Setups\Commands\Institution;
use Modules\Setups\Models\Institution;

class UpdateCommand
{
    public static function handle($data, $id): array
    {
        $institution = Institution::find($id);
        $isExist = Institution::isExistOnEdit($data['name'], $id);
        if (!$isExist) {
            $institution->update($data);
            //Sending Notification Back to Roles
            return [
                'message' => 'Institution Successfully Updated',
                'type' => 'success'
            ];
        } else {
            return [
                'message' => "Institution {$data['name']} Already Exist!",
                'type' => 'error'
            ];
        }
    }
}

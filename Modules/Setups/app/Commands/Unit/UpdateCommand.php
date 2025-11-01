<?php

namespace Modules\Setups\Commands\Unit;
use Modules\Setups\Models\Unit;

class UpdateCommand
{
    public static function handle($data, $id): array
    {
        $unit = Unit::find($id);
        $isExist = Unit::isExistOnEdit($data['name'], $id);
        if (!$isExist) {
            $unit->update($data);
            //Sending Notification Back to Roles
            return [
                'message' => 'Unit Successfully Updated',
                'type' => 'success'
            ];
        } else {
            return [
                'message' => "Unit {$data['name']} Already Exist!",
                'type' => 'error'
            ];
        }
    }
}

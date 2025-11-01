<?php

namespace Modules\Setups\Commands\Institution;

use Modules\Setups\Models\Institution;

class StoreCommand
{
    public static function handle($data): array
    {
        $isExist = Institution::isExist($data['name']);
        if (!$isExist) {
            Institution::create($data);
            //Sending Notification Back
            return [
                'message' => 'Institution Successfully Created!',
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

<?php

namespace Modules\Setups\Commands\Unit;
use Modules\Setups\Models\Unit;

class StoreCommand
{
    public static function handle($data): array
    {
        $isExist = Unit::isExist($data['name']);
        if (!$isExist) {
            Unit::create($data);
            //Sending Notification Back
            return [
                'message' => 'Unit Successfully Created!',
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

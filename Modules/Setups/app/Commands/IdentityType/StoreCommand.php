<?php

namespace Modules\Setups\Commands\IdentityType;

use Modules\Setups\Models\IdentityType;

class StoreCommand
{
    public static function handle($data): array
    {
        $isExist = IdentityType::isExist($data['name']);
        if (!$isExist) {
            IdentityType::create($data);
            //Sending Notification Back
            return [
                'message' => 'Identity Type Successfully Created!',
                'type' => 'success'
            ];
        } else {
            return [
                'message' => "Identity Type {$data['name']} Already Exist!",
                'type' => 'error'
            ];
        }
    }
}

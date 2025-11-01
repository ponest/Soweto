<?php

namespace Modules\Setups\Commands\IdentityType;

use Modules\Setups\Models\IdentityType;

class UpdateCommand
{
    public static function handle($data, $id): array
    {
        $identityType = IdentityType::find($id);
        $isExist = IdentityType::isExistOnEdit($data['name'], $id);
        if (!$isExist) {
            $identityType->update($data);
            //Sending Notification Back to Roles
            return [
                'message' => 'Identity Type Successfully Updated',
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

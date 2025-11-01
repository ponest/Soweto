<?php

namespace Modules\Auth\Commands\Roles;

use Modules\Auth\Models\Role;

class StoreCommand
{
    public static function handle($data): array
    {
        $role_exist = Role::isExist($data['name']);
        if (!$role_exist) {
            Role::create($data);
            //Sending Notification Back
            return [
                'message' => 'Role Successfully Created!',
                'type' => 'success'
            ];
        } else {
            return [
                'message' => "Role {$data['name']} Already Exist!",
                'type' => 'error'
            ];
        }
    }
}

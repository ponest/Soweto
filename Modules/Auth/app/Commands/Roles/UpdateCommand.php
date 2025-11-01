<?php

namespace Modules\Auth\Commands\Roles;

use Modules\Auth\Models\Role;

class UpdateCommand
{
    public static function handle($data, $id): array
    {
        $role = Role::find($id);
        $role_exist = Role::isExistOnEdit($data['name'], $id);
        if (!$role_exist) {
            $role->update($data);
            //Sending Notification Back to Roles
            return [
                'message' => 'Role Successfully Updated',
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

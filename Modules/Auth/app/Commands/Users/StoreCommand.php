<?php

namespace Modules\Auth\Commands\Users;

use Illuminate\Support\Facades\Hash;
use Modules\Auth\Models\RoleUser;
use Modules\Auth\Models\User;

class StoreCommand
{
    public static function handle($data): array
    {
        $data['password'] = Hash::make('12345');
        $user_exist = User::isExist($data['email']);
        if (!$user_exist) {
            $user = User::create($data);
            if ($user->id) {
                // Save roles. Handles updating.
                foreach ($data['roles'] as $role) {
                    $role_data['user_id'] = $user->id;
                    $role_data['role_id'] = $role;
                    RoleUser::create($role_data);
                }
            }

            //Sending Notification Back
            return [
                'message' => 'user Successfully Created!',
                'type' => 'success'
            ];
        } else {
            return [
                'message' => 'user with this email Already Exist!',
                'type' => 'error'
            ];
        }
    }
}

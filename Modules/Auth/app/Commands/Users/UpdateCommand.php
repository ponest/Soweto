<?php

namespace Modules\Auth\Commands\Users;

use Illuminate\Support\Facades\DB;
use Modules\Auth\Models\RoleUser;
use Modules\Auth\Models\User;

class UpdateCommand
{
    public static function handle($data, $id): array
    {
        $user = User::find($id);
        $user_exist = User::isExistOnEdit($data['email'], $id);
        if (!$user_exist) {
            $user->update($data);
            //Delete Existing Roles
            DB::table('role_user')->where('user_id', $id)->delete();
            foreach ($data['roles'] as $role) {
                $role_data['user_id'] = $id;
                $role_data['role_id'] = $role;
                RoleUser::create($role_data);
            }

            //Sending Notification Back to Roles
            return [
                'message' => 'user Successfully Updated',
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

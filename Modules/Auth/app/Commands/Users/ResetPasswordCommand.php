<?php

namespace Modules\Auth\Commands\Users;

use Exception;
use Illuminate\Support\Facades\Hash;
use Modules\Auth\Models\User;

class ResetPasswordCommand
{
    public static function handle($id): array
    {
        try {
            $user = User::find($id);
            $user->password = Hash::make('12345');
            $user->update();

            //Sending Notification Back to Roles
            return [
                'message' => 'User Successfully Reset Password',
                'type' => 'success'
            ];
        } catch (Exception $ex) {
            return [
                'message' => $ex->getMessage(),
                'type' => 'error'
            ];
        }
    }
}

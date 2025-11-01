<?php

namespace Modules\Setups\Commands\PaymentMethod;

use Exception;
use Illuminate\Support\Facades\Log;
use Modules\Setups\Models\PaymentMethod;

class DeleteCommand
{
    public static function handle($id): array
    {
        try {
            $item = PaymentMethod::find($id);
            $item->delete();

            //Sending Back Notification
            return [
                'message' => 'Payment Method Successfully Deleted!',
                'type' => 'success'
            ];
        } catch (Exception $ex) {
            Log::error($ex->getMessage());
            return [
                'message' => 'Sorry An Error Occurred!',
                'type' => 'error'
            ];
        }
    }
}

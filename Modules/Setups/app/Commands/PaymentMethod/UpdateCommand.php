<?php

namespace Modules\Setups\Commands\PaymentMethod;
use Modules\Setups\Models\PaymentMethod;

class UpdateCommand
{
    public static function handle($data, $id): array
    {
        $paymentMethod = PaymentMethod::find($id);
        $isExist = PaymentMethod::isExistOnEdit($data['name'], $id);
        if (!$isExist) {
            $paymentMethod->update($data);
            //Sending Notification Back to Roles
            return [
                'message' => 'Payment Method Successfully Updated',
                'type' => 'success'
            ];
        } else {
            return [
                'message' => "Payment Method {$data['name']} Already Exist!",
                'type' => 'error'
            ];
        }
    }
}

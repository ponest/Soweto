<?php

namespace Modules\Setups\Commands\PaymentMethod;
use Modules\Setups\Models\PaymentMethod;

class StoreCommand
{
    public static function handle($data): array
    {
        $isExist = PaymentMethod::isExist($data['name']);
        if (!$isExist) {
            PaymentMethod::create($data);
            //Sending Notification Back
            return [
                'message' => 'Payment Method Successfully Created!',
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

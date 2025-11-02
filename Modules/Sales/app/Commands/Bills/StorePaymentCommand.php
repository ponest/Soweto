<?php

namespace Modules\Sales\Commands\Bills;
use Modules\Sales\Models\Payment;

class StorePaymentCommand
{
    public static function handle($bill_id, $data): void
    {
        $payment = new Payment();
        $payment->bill_id = $bill_id;
        $payment->paid_amount = $data['paid_amount'];
        $payment->payment_method_id = $data['payment_method_id'];
        $payment->payment_reference = $data['payment_reference'];
        $payment->payment_confirmed_at = now();
        $payment->payment_confirmed_by = auth()->id();
        $payment->save();
    }
}

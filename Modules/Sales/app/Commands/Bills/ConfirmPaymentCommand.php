<?php

namespace Modules\Sales\Commands\Bills;

use Illuminate\Support\Facades\DB;
use Modules\Sales\Models\Bill;
use Modules\Sales\Models\Payment;
use Modules\Sales\Models\SalesBatch;

class ConfirmPaymentCommand
{
    public static function handle($data)
    {
        return DB::transaction(function () use ($data) {
            if ($data['payment_method_id'] != 1) {
                if ($data['payment_reference'] == null) {
                    //Sending Notification Back
                    return [
                        'message' => 'Please fill payment reference!',
                        'type' => 'error'
                    ];
                }
            }
            //Update Payment
            $payment = new Payment();
            $payment->bill_id = $data['id'];
            $payment->paid_amount = $data['paid_amount'];
            $payment->payment_method_id = $data['payment_method_id'];
            $payment->payment_reference = $data['payment_reference'];
            $payment->payment_confirmed_at = now();
            $payment->payment_confirmed_by = auth()->id();
            $payment->save();

            $bill = Bill::find($data['id']);
            $bill->paid_amount += $data['paid_amount'];
            $bill->payment_reference = $data['payment_reference'];
            if ($bill->paid_amount >= $bill->bill_amount) {
                $bill->status = 'Paid';
            }else{
                $bill->status = 'Partial Paid';
            }
            $bill->save();

            //Update Sales Batch
            if ($bill->category == "Sales") {
                $salesBatch = SalesBatch::find($bill->ref_id);
                $salesBatch->is_paid = true;
                $salesBatch->save();
            }

            //Sending Notification Back
            return [
                'message' => 'Payment Successfully Confirmed!',
                'type' => 'success'
            ];
        });
    }
}

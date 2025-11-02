<?php

namespace Modules\Sales\Commands\Bills;

use Illuminate\Support\Facades\DB;
use Modules\Sales\Models\Bill;
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
            StorePaymentCommand::handle($data['id'],$data);

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

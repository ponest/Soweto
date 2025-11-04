<?php

namespace Modules\HotelMgnt\Commands\CheckInOut;

use Illuminate\Support\Facades\DB;
use Modules\HotelMgnt\Models\ClientWallet;
use Modules\HotelMgnt\Models\RoomCheckInOut;
use Modules\HotelMgnt\Models\WalletTransaction;
use Modules\Sales\Commands\Bills\StorePaymentCommand;
use Modules\Sales\Models\Bill;
use Modules\Sales\Models\SalesBatch;

class ConfirmPaymentCommand
{
    public static function handle($data): array
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

            if ($data['payment_method_id'] == 4) {
                if ($data['wallet_balance'] < $data['paid_amount']){
                    return [
                        'message' => 'Paid Amount is Less than Wallet Balance!',
                        'type' => 'error'
                    ];
                }

                //Make Transaction
                $wallet =  ClientWallet::where('reference_no', $data['payment_reference'])->first();
                $walletTransaction = new WalletTransaction();
                $walletTransaction->wallet_id = $wallet->id;
                $walletTransaction->amount = $data['paid_amount'];
                $walletTransaction->save();
            }

            $bookingId = $data['booking_id'];
            $bill = Bill::where('booking_id', $bookingId)->first();
            $bill->paid_amount += $data['paid_amount'];
            if ($bill->paid_amount >= $bill->bill_amount) {
                $bill->status = 'Paid';

                $roomCheckInout = RoomCheckInOut::find($data['id']);
                $roomCheckInout->is_paid = true;
                $roomCheckInout->paid_amount = $bill->paid_amount;
                $roomCheckInout->save();

                //Update Sales Batch
                $salesBatches = SalesBatch::where('client_id', $roomCheckInout->booking->client_id)
                    ->where('room_id', $roomCheckInout->room_id)
                    ->where('is_paid',false)->get();
                foreach ($salesBatches as $salesBatch) {
                    $salesBatch->is_paid = true;
                    $salesBatch->save();
                }
            }else{
                $bill->status = 'Partial Paid';
            }
            $bill->save();

            //Update Payment
            StorePaymentCommand::handle($bill->id,$data);

            //Sending Notification Back
            return [
                'message' => 'Payment Successfully Confirmed!',
                'type' => 'success'
            ];
        });
    }

}

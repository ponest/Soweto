<?php

namespace Modules\HotelMgnt\Commands\CheckInOut;

use App\Enums\PaymentMethodEnum;
use Illuminate\Support\Facades\DB;
use Modules\General\Models\DiscountReq;
use Modules\General\Models\DiscountTransaction;
use Modules\HotelMgnt\Models\AdvancePayment;
use Modules\HotelMgnt\Models\AdvancePaymentTransaction;
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

            if ($data['payment_method_id'] != PaymentMethodEnum::CashId) {
                if ($data['payment_reference'] == null) {
                    //Sending Notification Back
                    return [
                        'message' => 'Please fill payment reference!',
                        'type' => 'error'
                    ];
                }
            }

            if ($data['payment_method_id'] == PaymentMethodEnum::WalletId) {
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

            if ($data['payment_method_id'] == PaymentMethodEnum::DiscountId) {
                if ($data['discount_balance'] < $data['paid_amount']){
                    return [
                        'message' => 'Paid Amount is Less than Discount Balance!',
                        'type' => 'error'
                    ];
                }

                //Make Transaction
                $discount =  DiscountReq::where('discount_code', $data['payment_reference'])->first();
                $discountTransaction = new DiscountTransaction();
                $discountTransaction->discount_id = $discount->id;
                $discountTransaction->amount = $data['paid_amount'];
                $discountTransaction->save();
            }

            if ($data['payment_method_id'] == PaymentMethodEnum::AdvancePaymentId) {
                if ($data['advance_balance'] < $data['paid_amount']){
                    return [
                        'message' => 'Paid Amount is Less than Advance Balance!',
                        'type' => 'error'
                    ];
                }

                //Make Transaction
                $advancePayment =  AdvancePayment::where('reference_number', $data['payment_reference'])->first();
                $advanceTransaction = new AdvancePaymentTransaction();
                $advanceTransaction->advance_payment_id = $advancePayment->id;
                $advanceTransaction->amount = $data['paid_amount'];
                $advanceTransaction->save();
                //Update Usage
                $advancePayment->is_used = true;
                $advancePayment->save();
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

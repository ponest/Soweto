<?php

namespace Modules\HotelMgnt\Http\Controllers;

use App\Enums\PaymentMethodEnum;
use App\Helpers\General;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Modules\HotelMgnt\Commands\AdvancePayment\DeleteCommand;
use Modules\HotelMgnt\Commands\AdvancePayment\StoreCommand;
use Modules\HotelMgnt\Commands\AdvancePayment\UpdateCommand;
use Modules\HotelMgnt\Models\AdvancePayment;
use Modules\HotelMgnt\Models\AdvancePaymentTransaction;
use Modules\HotelMgnt\Models\Booking;
use Modules\Setups\Models\PaymentMethod;

class AdvancePaymentController extends Controller
{
    public function index()
    {
        $params['items'] = AdvancePayment::latest('id')->get();
        $params['bookings'] = Booking::whereBookingStatus('CheckedIn')->latest('id')->get();
        $exclude = array(PaymentMethodEnum::WalletId, PaymentMethodEnum::DiscountId);
        $params['payment_methods'] = PaymentMethod::whereNotIn('id',$exclude)->orderBy('name')->get();
        return view('hotelmgnt::advance_payment.index', $params);
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $info = StoreCommand::handle($data);
        $notification = General::customMessage($info['message'], $info['type']);
        return Redirect::back()->with($notification);
    }

    public function edit($id)
    {
        $params['item'] = AdvancePayment::find($id);
        $params['bookings'] = Booking::whereBookingStatus('CheckedIn')->latest('id')->get();
        $exclude = array(PaymentMethodEnum::WalletId, PaymentMethodEnum::DiscountId);
        $params['payment_methods'] = PaymentMethod::whereNotIn('id',$exclude)->orderBy('name')->get();
        return view('hotelmgnt::advance_payment.edit', $params);
    }


    public function update(Request $request, $id)
    {
        $data = $request->all();
        $info = UpdateCommand::handle($data, $id);
        $notification = General::customMessage($info['message'], $info['type']);
        return Redirect::back()->with($notification);
    }

    public function destroy($id)
    {
        $info = DeleteCommand::handle($id);
        $notification = General::customMessage($info['message'], $info['type']);
        return Redirect::back()->with($notification);
    }

    public function getPaymentDetails(Request $request)
    {
        $advancePayment = AdvancePayment::whereReferenceNumber($request->reference_number)->first();
        if ($advancePayment) {
            $total_transaction = AdvancePaymentTransaction::whereAdvancePaymentId($advancePayment->id)->sum('amount');
            $balance = $advancePayment->amount - $total_transaction;
            $advance_amount = $advancePayment->amount;
            return response()->json([
                'success' => true,
                'message' => 'Advance Payment Successfully Found',
                'balance' => $balance,
                'total_transaction' => $total_transaction,
                'advance_amount' => $advance_amount,
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Advance Payment not found'
            ]);
        }
    }
}

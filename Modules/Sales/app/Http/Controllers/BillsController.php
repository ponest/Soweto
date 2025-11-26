<?php

namespace Modules\Sales\Http\Controllers;

use App\Helpers\General;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Redirect;
use Modules\Auth\Models\User;
use Modules\Sales\Commands\Bills\ConfirmPaymentCommand;
use Modules\Sales\Models\Bill;
use Modules\Sales\Models\BillItem;
use Modules\Sales\Models\Payment;
use Modules\Setups\Models\PaymentMethod;

class BillsController extends Controller
{

    public function index()
    {
        if (Gate::allows('Cashier')) {
            $params['items'] = Bill::where('status','!=','paid')->latest('id')->limit(1000)->get();
        } elseif (Gate::allows('FrontOfficer')) {
            $params['items'] = Bill::where('status','!=','paid')->whereNotNull('booking_id')->latest('id')->limit(1000)->get();
        } else {
            $storeId = User::userStoreId();

            $params['items'] = Bill::join('bill_items', 'bills.id', '=', 'bill_items.bill_id')
                ->where('bill_items.store_id', $storeId)
                ->where('status','!=','paid')
                ->select('bills.*')
                ->distinct()
                ->latest('bills.id')
                ->get();
        }
        return view('sales::bills.index', $params);
    }


    public function paid()
    {
        if (Gate::allows('Cashier')) {
            $params['items'] = Bill::where('status','paid')->latest('id')->limit(1000)->get();
        } elseif (Gate::allows('FrontOfficer')) {
            $params['items'] = Bill::where('status','paid')->whereNotNull('booking_id')->latest('id')->limit(1000)->get();
        } else {
            $storeId = User::userStoreId();

            $params['items'] = Bill::join('bill_items', 'bills.id', '=', 'bill_items.bill_id')
                ->where('bill_items.store_id', $storeId)
                ->where('status','paid')
                ->select('bills.*')
                ->distinct()
                ->latest('bills.id')
                ->get();
        }
        return view('sales::bills.paid', $params);
    }

    public function confirmPaymentView($id)
    {
        $params['item'] = Bill::find($id);
        $params['payment_methods'] = PaymentMethod::orderBy('name')->get();
        return view('sales::bills.payment_conf', $params);
    }

    public function confirmPayment(Request $request)
    {
        $data = $request->all();
        $info = ConfirmPaymentCommand::handle($data);
        $notification = General::customMessage($info['message'], $info['type']);
        return Redirect::back()->with($notification);
    }

    public function paymentView($id)
    {
        $params['items'] = Payment::whereBillId($id)->get();
        return view('sales::bills.payment', $params);
    }

    public function billItems($id)
    {
        $params['items'] = BillItem::whereBillId($id)->get();
        return view('sales::bills.bill_items', $params);
    }
}

<?php

namespace Modules\Sales\Http\Controllers;

use App\Helpers\General;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Modules\Auth\Models\User;
use Modules\Sales\Commands\Bills\ConfirmPaymentCommand;
use Modules\Sales\Models\Bill;
use Modules\Sales\Models\Payment;
use Modules\Setups\Models\PaymentMethod;

class BillsController extends Controller
{

    public function index()
    {
        $departmentId = User::currentUserDepartmentId();
        $params['items'] = Bill::whereDepartmentId($departmentId)->latest('id')->get();
        return view('sales::bills.index', $params);
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
}

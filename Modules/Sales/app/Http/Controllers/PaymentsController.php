<?php

namespace Modules\Sales\Http\Controllers;

use App\Exports\ExpPaymentReport;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Maatwebsite\Excel\Facades\Excel;
use Modules\Sales\Models\Payment;
use Modules\Setups\Models\PaymentMethod;

class PaymentsController extends Controller
{
    public function paymentHistory()
    {
        $params['items'] = Payment::latest('id')->limit(100)->get();
        $params['payment_methods'] = PaymentMethod::orderBy('name')->get();
        $params['is_post_back'] = false;
        return view('sales::payment.index', $params);
    }

    public function paymentHistoryFilter(Request $request)
    {
        $data = $request->all();
//        dd($data);
        $params['payment_methods'] = PaymentMethod::orderBy('name')->get();
        $prefix = "Payment Report";
        $query = Payment::query();
        if ($data['start_date'] != null && $data['end_date'] != null) {
            $start_date = Carbon::parse($data['start_date'])->startOfDay();
            $end_date = Carbon::parse($data['end_date'])->endOfDay();
            $query->whereBetween('created_at', [$start_date, $end_date]);
            $prefix = $prefix." From " . date('d M Y', strtotime($data['start_date'])) . " To " . date('d M Y', strtotime($data['end_date']));

        }
        if ($data['payment_method_id'] != null) {
            $query->where('payment_method_id', $data['payment_method_id']);
            $method = PaymentMethod::find($data['payment_method_id'])->name;
            $prefix = $prefix. " for ".$method." Payment method";
        }
        $params['total_price'] = $query->sum('paid_amount');
        $params['items'] = $query->latest()->get();

        $params['is_post_back'] = true;
        session(['payment_data' => $params['items']]);
        session(['total_payments' => $params['total_price']]);
        session(['header_prefix' => $prefix]);
        return view('sales::payment.index', $params);
    }

    public function downloadExcel()
    {
        return Excel::download(new ExpPaymentReport(), 'payment_report.xlsx');
    }
}

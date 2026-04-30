<?php

namespace Modules\Sales\Http\Controllers;

use App\Exports\ExpPaymentReport;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Maatwebsite\Excel\Facades\Excel;
use Modules\Sales\Models\BillItem;
use Modules\Sales\Models\Payment;
use Modules\Setups\Models\PaymentMethod;

class PaymentsController extends Controller
{
    public function paymentHistory()
    {
        $params['items'] = Payment::latest('id')->latest('id')->limit(500)->get();
        $params['payment_methods'] = PaymentMethod::orderBy('name')->get();
        $params['bill_sources'] = BillItem::distinct()->pluck('bill_source');
        $params['is_post_back'] = false;
        $params['header'] = "PAYMENT HISTORY";
        return view('sales::payment.index', $params);
    }

    public function paymentHistoryFilter(Request $request)
    {
        $data = $request->all();
        $params['payment_methods'] = PaymentMethod::orderBy('name')->get();
        $params['bill_sources'] = BillItem::distinct()->pluck('bill_source');
        $prefix = "Payment Report";
        $query = Payment::query();
        if ($data['start_date'] != null && $data['end_date'] != null) {
            $start_date = Carbon::parse($data['start_date'])->startOfDay();
            $end_date = Carbon::parse($data['end_date'])->endOfDay();
            $query->whereBetween('payments.created_at', [$start_date, $end_date]);
            $prefix = $prefix . " From " . date('d M Y', strtotime($data['start_date'])) . " To " . date('d M Y', strtotime($data['end_date']));
        }
        if ($data['payment_method_id'] != null) {
            $query->where('payment_method_id', $data['payment_method_id']);
            $method = PaymentMethod::find($data['payment_method_id'])->name;
            $prefix = $prefix . " for " . $method . " Payment method";
        }
        if ($data['bill_source'] != null) {
            $query->join('bills', 'bills.id', '=', 'payments.bill_id')
                ->join('bill_items', 'bills.id', '=', 'bill_items.bill_id')
                ->where('bill_items.bill_source', $data['bill_source']);
            $prefix = $prefix . " for " . $data['bill_source'];
        }
//        $params['total_price'] = $query->sum('payments.paid_amount');
        $params['total_price'] = (clone $query)
            ->select('payments.id', 'payments.paid_amount')
            ->groupBy('payments.id', 'payments.paid_amount')
            ->get()
            ->sum('paid_amount');

        // clone query so sum query doesn't affect results
//        $params['items'] = (clone $query)
//            ->select('payments.*')
//            ->latest('payments.id')
//            ->get();

        $params['items'] = (clone $query)
            ->select('payments.*')
            ->distinct()
            ->latest('payments.id')
            ->get();

        $params['is_post_back'] = true;
        session(['payment_data' => $params['items']]);
        session(['total_payments' => $params['total_price']]);
        session(['header_prefix' => $prefix]);
        $params['header'] = $prefix;
        return view('sales::payment.index', $params);
    }

    public function downloadExcel()
    {
        return Excel::download(new ExpPaymentReport(), 'payment_report.xlsx');
    }
}

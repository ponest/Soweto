<?php

namespace Modules\Reports\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use Modules\Reports\Queries\Revenue\WeeklyRevenueByPaymentMethodQuery;
use Modules\Reports\Queries\Revenue\WeeklyRevenueQuery;
use Modules\Sales\Models\Bill;
use Modules\Sales\Models\Payment;

class DashboardController extends Controller
{
    public function index()
    {
        if (Gate::allows('Accountant')) {
            return $this->accountDashboard();
        } else {
            return $this->defaultDashboard();
        }
    }

    public function defaultDashboard()
    {
        return view('auth::dashboards.main');
    }

    public function accountDashboard()
    {
        $result = WeeklyRevenueQuery::handle();
        $resultByMethod = WeeklyRevenueByPaymentMethodQuery::handle();
        $params = array_merge($result, $resultByMethod);

        $billInfo['totalRevenue'] = Payment::sum('paid_amount');
        $billInfo['dailyRevenue'] = Payment::whereDate('created_at', today())
            ->sum('paid_amount');
        $billInfo['unpaidBills'] = Bill::where('status','unpaid')
            ->sum('bill_amount');
        $params = array_merge($params, $billInfo);

        return view('auth::dashboards.accounts_dashboard', $params);
    }
}

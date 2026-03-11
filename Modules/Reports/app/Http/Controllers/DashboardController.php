<?php

namespace Modules\Reports\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use Modules\HotelMgnt\Models\Room;
use Modules\HotelMgnt\Models\RoomCheckInOut;
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
        }elseif (Gate::allows('FrontOfficer')) {
            return $this->frontOfficeDashboard();
        }
        else {
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

    public function frontOfficeDashboard()
    {
        $params['totalRooms'] = Room::count();
        $params['occupiedRooms'] = Room::whereStatus('Occupied')->count();
        $params['availableRooms'] = $params['totalRooms'] - $params['occupiedRooms'];
        $params['checkIns'] = RoomCheckInOut::whereDate('checked_in_at', today())->count();
        $params['checkOuts'] = RoomCheckInOut::whereDate('checked_out_at', today())->count();

        return view('auth::dashboards.front_dashboard', $params);
    }
}

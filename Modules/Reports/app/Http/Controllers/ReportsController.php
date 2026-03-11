<?php

namespace Modules\Reports\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Modules\Reports\Commands\Revenue\CreateDailyRevenueCommand;
use Modules\Reports\Models\DailyRevenue;
use Modules\Sales\Models\Payment;

class ReportsController extends Controller
{

    public function index()
    {
       CreateDailyRevenueCommand::handle();
    }

    public function calculateDailyRevenue()
    {
        $date = Carbon::yesterday();

        $totals = Payment::whereDate('created_at', $date)
            ->select(
                DB::raw('DATE(created_at) as date'),
                'payment_method_id',
                DB::raw('SUM(paid_amount) as total')
            )
            ->groupBy('date','payment_method_id')
            ->get();

        foreach ($totals as $row) {

            $date = Carbon::parse($row->date);

            DailyRevenue::updateOrCreate(
                [
                    'date' => $date->format('Y-m-d'),
                    'payment_method_id' => $row->payment_method_id
                ],
                [
                    'day' => $date->format('d'),
                    'month' => $date->format('m'),
                    'year' => $date->format('Y'),
                    'amount' => $row->total
                ]
            );
        }

        return response()->json([
            'success' => true,
            'totals' => $totals,
            'message' => 'Success'
        ]);
    }


}

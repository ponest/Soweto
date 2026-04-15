<?php

namespace Modules\Reports\Http\Controllers;

use App\Enums\GeneralEnum;
use App\Exports\DailyStockReport;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Modules\Inventory\Models\Store;
use Modules\Reports\Models\DailyRoomStatus;
use Modules\Reports\Models\DailyStockSheet;

class ReportsController extends Controller
{

    public function dailyStockSheetIndex()
    {
        $params['stores'] = Store::whereIn('id', GeneralEnum::StockSheetStoreArray)->get();
        $params['is_post_back'] = false;
        return view('reports::stock_sheet.index', $params);
    }

    public function getDailyStockSheet(Request $request)
    {
        $data = $request->all();
        $params['stores'] = Store::whereIn('id', GeneralEnum::StockSheetStoreArray)->get();
        $params['is_post_back'] = true;
        $params['items'] = DailyStockSheet::where('store_id', $data['store_id'])
            ->where('date', $data['date'])->get();
        $store = Store::find($data['store_id']);
        $params['header'] = "Daily Stock Sheet for " . $store->name . " on " . $data['date'];

        session(['items_data' => $params['items']]);
        session(['header' => $params['header']]);
        return view('reports::stock_sheet.index', $params);
    }

    public function dailyStockSheetExcel()
    {
        return Excel::download(new DailyStockReport(), 'daily_stock_sheet.xlsx');
    }

    public function dailyRoomStatusIndex()
    {
        $params['is_post_back'] = false;
        return view('reports::room_status.index', $params);
    }

    public function getDailyRoomStatus(Request $request)
    {
        $data = $request->all();
        $params['is_post_back'] = true;
        $params['items'] = DailyRoomStatus::where('date', $data['date'])->get();
        $params['header'] = "Daily Room  Status as at " . date('d-m-Y', strtotime($data['date']));

        session(['room_status_data' => $params['items']]);
        session(['header' => $params['header']]);
        return view('reports::room_status.index', $params);
    }
}

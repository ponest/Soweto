<?php

namespace Modules\Inventory\Http\Controllers;

use App\Helpers\General;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Modules\Inventory\Commands\StockItem\DeleteCommand;
use Modules\Inventory\Commands\StockItem\StoreCommand;
use Modules\Inventory\Commands\StockItem\UpdateCommand;
use Modules\Inventory\Models\StockItem;
use Modules\Setups\Models\ItemCategory;
use Modules\Setups\Models\Unit;

class StockItemController extends Controller
{
    public function index()
    {
        $params['items'] = StockItem::latest('id')->get();
        $params['categories'] = ItemCategory::orderBy('name')->get();
        $params['units'] = Unit::orderBy('name')->get();
        return view('inventory::stock_items.index', $params);
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
        $params['item'] = StockItem::find($id);
        $params['categories'] = ItemCategory::orderBy('name')->get();
        $params['units'] = Unit::orderBy('name')->get();
        return view('inventory::stock_items.edit', $params);
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

    public function getUnit(Request $request)
    {
        $stock_item = StockItem::find($request->item_id);
        if ($stock_item) {
            $unit['unit_id'] = $stock_item->unit_id;
            $unit['unit_name'] = Unit::find($unit['unit_id'])->name;
            $response = [
                'msg' => "Unit Successfully Fetched",
                'status' => 'success',
                'data' => $unit
            ];
        } else {
            $response = [
                'status' => 'fail',
                'msg' => "Unit not found"
            ];
        }
        return response()->json($response);
    }
}

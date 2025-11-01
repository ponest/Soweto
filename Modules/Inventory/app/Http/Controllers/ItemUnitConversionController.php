<?php

namespace Modules\Inventory\Http\Controllers;

use App\Helpers\General;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Modules\Inventory\Commands\UnitConversion\DeleteCommand;
use Modules\Inventory\Commands\UnitConversion\StoreCommand;
use Modules\Inventory\Commands\UnitConversion\UpdateCommand;
use Modules\Inventory\Models\ItemUnitConversion;
use Modules\Inventory\Models\StockItem;
use Modules\Setups\Models\Unit;

class ItemUnitConversionController extends Controller
{
    public function index()
    {
        $params['items'] = ItemUnitConversion::latest('id')->get();
        $params['units'] = Unit::orderBy('name')->get();
        $params['stock_items'] = StockItem::orderBy('name')->get();
        return view('inventory::item_conversions.index', $params);
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
        $params['item'] = ItemUnitConversion::find($id);
        $params['units'] = Unit::orderBy('name')->get();
        $params['stock_items'] = StockItem::orderBy('name')->get();
        return view('inventory::item_conversions.edit', $params);
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
}

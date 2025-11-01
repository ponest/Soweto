<?php

namespace Modules\Inventory\Http\Controllers;

use App\Helpers\General;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Modules\Auth\Models\User;
use Modules\Inventory\Commands\ItemStockIn\DeleteCommand;
use Modules\Inventory\Commands\ItemStockIn\StoreCommand;
use Modules\Inventory\Commands\ItemStockIn\UpdateCommand;
use Modules\Inventory\Models\ItemStockIn;
use Modules\Inventory\Models\StockItem;
use Modules\Inventory\Models\Supplier;
use Modules\Setups\Models\Unit;

class ItemStockInController extends Controller
{
    public function index()
    {
        $departmentId = User::currentUserDepartmentId();
        $params['items'] = ItemStockIn::whereDepartmentId($departmentId)->latest('id')->get();
        $params['suppliers'] = Supplier::orderBy('name')->get();
        $params['stock_items'] = StockItem::orderBy('name')->get();
        $params['units'] = Unit::orderBy('name')->get();
        return view('inventory::item_stock_in.index', $params);
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
        $params['item'] = ItemStockIn::find($id);
        $params['suppliers'] = Supplier::orderBy('name')->get();
        $params['stock_items'] = StockItem::orderBy('name')->get();
        $params['units'] = Unit::orderBy('name')->get();
        return view('inventory::item_stock_in.edit', $params);
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

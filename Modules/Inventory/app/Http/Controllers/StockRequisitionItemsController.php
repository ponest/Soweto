<?php

namespace Modules\Inventory\Http\Controllers;

use App\Helpers\General;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Modules\Inventory\Commands\StockRequisitionItem\DeleteCommand;
use Modules\Inventory\Commands\StockRequisitionItem\StoreCommand;
use Modules\Inventory\Commands\StockRequisitionItem\UpdateCommand;
use Modules\Inventory\Models\StockItem;
use Modules\Inventory\Models\StockRequisition;
use Modules\Inventory\Models\StockRequisitionItem;

class StockRequisitionItemsController extends Controller
{
    public function index($id, $type = null)
    {
        $params['items'] = StockRequisitionItem::whereStockRequisitionId($id)->latest('id')->get();
        $params['stock_items'] = StockItem::getAll();
        $params['requisition'] = StockRequisition::find($id);
        $params['type'] = $type;
        return view('inventory::stock_requisition_items.index', $params);
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
        $params['item'] = StockRequisitionItem::find($id);
        $params['stock_items'] = StockItem::getAll();
        return view('inventory::stock_requisition_items.edit', $params);
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

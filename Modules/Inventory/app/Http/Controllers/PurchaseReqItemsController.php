<?php

namespace Modules\Inventory\Http\Controllers;

use App\Helpers\General;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Modules\Inventory\Commands\PurchaseRequestItem\DeleteCommand;
use Modules\Inventory\Commands\PurchaseRequestItem\StoreCommand;
use Modules\Inventory\Commands\PurchaseRequestItem\UpdateCommand;
use Modules\Inventory\Models\PurchaseReqItem;
use Modules\Inventory\Models\PurchaseRequest;
use Modules\Inventory\Models\StockItem;

class PurchaseReqItemsController extends Controller
{
    public function index($id, $type = null)
    {
        $params['items'] = PurchaseReqItem::wherePurchaseRequestId($id)->latest('id')->get();
        $params['stock_items'] = StockItem::getAll();
        $params['requisition'] = PurchaseRequest::find($id);
        $params['type'] = $type;
        return view('inventory::purchase_request_items.index', $params);
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
        $params['item'] = PurchaseReqItem::find($id);
        $params['stock_items'] = StockItem::getAll();
        return view('inventory::purchase_request_items.edit', $params);
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

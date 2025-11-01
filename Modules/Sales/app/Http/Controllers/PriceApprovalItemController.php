<?php

namespace Modules\Sales\Http\Controllers;

use App\Helpers\General;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Modules\Inventory\Models\StockItem;
use Modules\Sales\Commands\PriceApprovalItem\DeleteCommand;
use Modules\Sales\Commands\PriceApprovalItem\StoreCommand;
use Modules\Sales\Commands\PriceApprovalItem\UpdateCommand;
use Modules\Sales\Models\ItemPriceApproval;
use Modules\Sales\Models\PriceApprovalItem;

class PriceApprovalItemController extends Controller
{
    public function index($id, $type = null)
    {
        $params['items'] = PriceApprovalItem::wherePriceApprovalId($id)->latest('id')->get();
        $params['stock_items'] = StockItem::getAll();
        $params['price_approval'] = ItemPriceApproval::find($id);
        $params['type'] = $type;
        return view('sales::menu_price_approval_items.index', $params);
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
        $params['item'] = PriceApprovalItem::find($id);
        $params['stock_items'] = StockItem::getAll();
        return view('sales::price_approval_items.edit', $params);
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

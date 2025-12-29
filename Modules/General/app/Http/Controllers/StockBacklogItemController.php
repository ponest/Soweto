<?php

namespace Modules\General\Http\Controllers;

use App\Helpers\General;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Modules\General\Commands\StockBacklogItem\UpdateCommand;
use Modules\General\Models\StockBacklogItem;
use Modules\General\Models\StockBacklogRequest;
use Modules\General\Commands\StockBacklogItem\StoreCommand;
use Modules\General\Commands\StockBacklogItem\DeleteCommand;
use Modules\Inventory\Models\StockItem;

class StockBacklogItemController extends Controller
{
    public function index($id)
    {
        $params['items'] = StockBacklogItem::whereBacklogRequestId($id)->latest('id')->get();
        $params['stock_items'] = StockItem::getAll();
        $params['requisition'] = StockBacklogRequest::find($id);
        return view('general::stock_backlog_item.index', $params);
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
        $params['item'] = StockBacklogItem::find($id);
        $params['stock_items'] = StockItem::getAll();
        return view('general::stock_backlog_item.edit', $params);
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

    public function show($id)
    {
        $params['items'] = StockBacklogItem::whereBacklogRequestId($id)->get();
        return view('general::stock_backlog.items_view', $params);
    }

}

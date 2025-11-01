<?php

namespace Modules\Inventory\Http\Controllers;

use App\Helpers\General;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Modules\Auth\Models\User;
use Modules\Inventory\Commands\StockIssue\ConfirmItemCommand;
use Modules\Inventory\Commands\StockIssue\IssueStockCommand;
use Modules\Inventory\Commands\StockIssue\ReceiveStockCommand;
use Modules\Inventory\Models\StockIssue;
use Modules\Inventory\Models\StockItem;
use Modules\Inventory\Models\StockRequisition;
use Modules\Inventory\Models\StockRequisitionItem;

class StockIssuingController extends Controller
{

    public function request()
    {
        $params['stockRequests'] = StockRequisition::whereIsApproved(true)->get();
        return view('inventory::stock_issue.requests', $params);
    }

    public function confirmItemView($id)
    {
        $params['stock_item'] = StockRequisitionItem::find($id);
        $params['balance'] = StockItem::getStoreItemBalance($params['stock_item']->stock_item_id);
        return view('inventory::stock_issue.confirm_item', $params);
    }

    public function confirmItem(Request $request)
    {
        $data = $request->all();
        $info = ConfirmItemCommand::handle($data);
        $notification = General::customMessage($info['message'], $info['type']);
        return Redirect::back()->with($notification);
    }

    public function issueStock($id)
    {
        $info = IssueStockCommand::handle($id);
        $notification = General::customMessage($info['message'], $info['type']);
        return Redirect::back()->with($notification);
    }

    public function index()
    {
        $storeId = User::userStoreId();
        $params['items'] = StockIssue::whereStoreId($storeId)->latest()->get();
        return view('inventory::stock_issue.index', $params);
    }

    public function receiveStock($id)
    {
        $info = ReceiveStockCommand::handle($id);
        $notification = General::customMessage($info['message'], $info['type']);
        return Redirect::back()->with($notification);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
    }
}

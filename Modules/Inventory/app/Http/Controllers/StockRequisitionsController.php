<?php

namespace Modules\Inventory\Http\Controllers;

use App\Helpers\General;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Modules\Inventory\Commands\StockRequisition\ApproveCommand;
use Modules\Inventory\Commands\StockRequisition\DeleteCommand;
use Modules\Inventory\Commands\StockRequisition\RejectCommand;
use Modules\Inventory\Commands\StockRequisition\StoreCommand;
use Modules\Inventory\Commands\StockRequisition\SubmitCommand;
use Modules\Inventory\Commands\StockRequisition\UpdateCommand;
use Modules\Inventory\Models\StockRequisition;
use Modules\Inventory\Models\StockRequisitionItem;

class StockRequisitionsController extends Controller
{
    public function index()
    {
        $userStoreId = auth()->user()->store_id;
        if ($userStoreId) {
            $params['items'] = StockRequisition::whereStoreId($userStoreId)->latest('id')->get();
            return view('inventory::stock_requisition.index', $params);
        } else {
            $notification = General::customMessage("User is not assigned to a store", "error");
            return Redirect::back()->with($notification);
        }
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
        $params['item'] = StockRequisition::find($id);
        return view('inventory::stock_requisition.edit', $params);
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

    public function submitRequest($id)
    {
        $info = SubmitCommand::handle($id);
        $notification = General::customMessage($info['message'], $info['type']);
        return Redirect::back()->with($notification);
    }

    public function approveRequest($id)
    {
        $info = ApproveCommand::handle($id);
        $notification = General::customMessage($info['message'], $info['type']);
        return Redirect::back()->with($notification);
    }

    public function approverView()
    {
        $params['items'] = StockRequisition::whereNotNull('submitted_at')->latest('id')->get();
        return view('inventory::stock_requisition.approval_view', $params);
    }

    public function viewItems($id)
    {
        $params['items'] = StockRequisitionItem::whereStockRequisitionId($id)->get();
        return view('inventory::stock_requisition.items_view', $params);
    }

    public function rejectView($id)
    {
        $params['id'] = $id;
        return view('inventory::stock_requisition.reject_view', $params);
    }

    public function rejectRequest(Request $request)
    {
        $data = $request->all();
        $id = $data['id'];
        $info = RejectCommand::handle($id, $data);
        $notification = General::customMessage($info['message'], $info['type']);
        return Redirect::back()->with($notification);
    }
}

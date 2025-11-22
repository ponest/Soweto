<?php

namespace Modules\Inventory\Http\Controllers;

use App\Helpers\General;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Modules\Inventory\Commands\PurchaseReqCost\DeleteCommand;
use Modules\Inventory\Commands\PurchaseReqCost\StoreCommand;
use Modules\Inventory\Commands\PurchaseReqCost\UpdateCommand;
use Modules\Inventory\Models\PurchaseReqAdditionalCost;
use Modules\Inventory\Models\PurchaseRequest;

class PurchaseReqAdditionalCostController extends Controller
{
    public function index($id)
    {
        $params['items'] = PurchaseReqAdditionalCost::wherePurchaseRequestId($id)->latest('id')->get();
        $params['requisition'] = PurchaseRequest::find($id);
        return view('inventory::purchase_req_additional_cost.index', $params);
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
        $params['item'] = PurchaseReqAdditionalCost::find($id);
        return view('inventory::purchase_req_additional_cost.edit', $params);
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

<?php

namespace Modules\Inventory\Http\Controllers;

use App\Helpers\General;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Redirect;
use Modules\Inventory\Commands\PurchaseRequest\ApproveCommand;
use Modules\Inventory\Commands\PurchaseRequest\DeleteCommand;
use Modules\Inventory\Commands\PurchaseRequest\PreviewCommand;
use Modules\Inventory\Commands\PurchaseRequest\ReviewCommand;
use Modules\Inventory\Commands\PurchaseRequest\StoreCommand;
use Modules\Inventory\Commands\PurchaseRequest\SubmitCommand;
use Modules\Inventory\Commands\PurchaseRequest\UpdateCommand;
use Modules\Inventory\Models\PurchaseReqAdditionalCost;
use Modules\Inventory\Models\PurchaseReqItem;
use Modules\Inventory\Models\PurchaseRequest;

class PurchaseRequestController extends Controller
{

    public function index()
    {
        $params['items'] = PurchaseRequest::latest('id')->get();
        return view('inventory::purchase_request.index', $params);
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
        $params['item'] = PurchaseRequest::find($id);
        return view('inventory::purchase_request.edit', $params);
    }

    public function update(Request $request, $id)
    {
        $data = $request->all();
        $info = UpdateCommand::handle($data, $id);
        $notification = General::customMessage($info['message'], $info['type']);
        return Redirect::back()->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     */
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

    public function approverView()
    {
        if (Gate::allows('Cashier')) {
            $params['items'] = PurchaseRequest::whereNotNull('submitted_at')
                ->whereNull('previewed_by')->latest('id')->get();
        } else if (Gate::allows('Manager')) {
            $params['items'] = PurchaseRequest::whereNotNull('previewed_by')
                ->whereNull('reviewed_by')->latest('id')->get();
        } else if (Gate::allows('Director')) {
            $params['items'] = PurchaseRequest::whereNotNull('reviewed_by')
                ->whereNull('approved_by')->latest('id')->get();
        }
        $params['approved_view'] = false;
        return view('inventory::purchase_request.approval_view', $params);
    }

    public function previewRequest($id)
    {
        $info = PreviewCommand::handle($id);
        $notification = General::customMessage($info['message'], $info['type']);
        return Redirect::back()->with($notification);
    }

    public function reviewRequest($id)
    {
        $info = ReviewCommand::handle($id);
        $notification = General::customMessage($info['message'], $info['type']);
        return Redirect::back()->with($notification);
    }

    public function approveRequest($id)
    {
        $info = ApproveCommand::handle($id);
        $notification = General::customMessage($info['message'], $info['type']);
        return Redirect::back()->with($notification);
    }


    public function viewItems($id)
    {
        $params['items'] = PurchaseReqItem::wherePurchaseRequestId($id)->get();
        $params['additional_costs'] = PurchaseReqAdditionalCost::wherePurchaseRequestId($id)->get();
        return view('inventory::purchase_request.items_view', $params);
    }
}

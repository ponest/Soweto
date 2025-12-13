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
use Modules\Inventory\Commands\PurchaseRequest\RejectCommand;
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
                ->whereNull(['reject_comments','reviewed_by'])->latest('id')->get();
        } else if (Gate::allows('Director')) {
            $params['items'] = PurchaseRequest::whereNotNull('reviewed_by')
                ->whereNull(['approved_by','reject_comments'])->latest('id')->get();
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

    public function approved()
    {
        $params['items'] = PurchaseRequest::whereIsApproved(true)->latest('id')->get();
        return view('inventory::purchase_request.approved', $params);
    }

    public function viewItems($id)
    {
        $params['items'] = PurchaseReqItem::wherePurchaseRequestId($id)->get();
        $params['additional_costs'] = PurchaseReqAdditionalCost::wherePurchaseRequestId($id)->get();
        $params['total_items_cost'] = collect($params['items'])->sum('total_price');
        $params['total_additional_costs'] = collect($params['additional_costs'])->sum('amount');
        return view('inventory::purchase_request.items_view', $params);
    }

    public function rejectView($id)
    {
        $params['id'] = $id;
        return view('inventory::purchase_request.reject_view', $params);
    }

    public function rejectRequest(Request $request)
    {
        $data = $request->all();
        $id = $data['id'];
        $info = RejectCommand::handle($id, $data);
        $notification = General::customMessage($info['message'], $info['type']);
        return Redirect::back()->with($notification);
    }

    public function rejected()
    {
        $params['items'] = PurchaseRequest::whereIsApproved(false)->latest('id')->get();
        return view('inventory::purchase_request.rejected', $params);
    }

}

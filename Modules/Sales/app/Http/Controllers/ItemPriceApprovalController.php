<?php

namespace Modules\Sales\Http\Controllers;

use App\Helpers\General;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Modules\Sales\Commands\ItemPriceApproval\ApproveCommand;
use Modules\Sales\Commands\ItemPriceApproval\DeleteCommand;
use Modules\Sales\Commands\ItemPriceApproval\RejectCommand;
use Modules\Sales\Commands\ItemPriceApproval\StoreCommand;
use Modules\Sales\Commands\ItemPriceApproval\SubmitCommand;
use Modules\Sales\Commands\ItemPriceApproval\UpdateCommand;
use Modules\Sales\Models\ItemPriceApproval;
use Modules\Sales\Models\PriceApprovalItem;

class ItemPriceApprovalController extends Controller
{
    public function index()
    {
        $params['items'] = ItemPriceApproval::latest('id')->get();
        return view('sales::price_approval.index', $params);
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
        $params['item'] = ItemPriceApproval::find($id);
        return view('sales::price_approval.edit', $params);
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
        $params['items'] = ItemPriceApproval::whereNotNull('submitted_at')->latest('id')->get();
        return view('sales::price_approval.approval_view', $params);
    }

    public function viewItems($id)
    {
        $params['items'] = PriceApprovalItem::wherePriceApprovalId($id)->get();
        return view('sales::price_approval.items_view', $params);
    }

    public function rejectView($id)
    {
        $params['id'] = $id;
        return view('sales::price_approval.reject_view', $params);
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

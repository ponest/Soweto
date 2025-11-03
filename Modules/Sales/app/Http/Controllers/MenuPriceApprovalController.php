<?php

namespace Modules\Sales\Http\Controllers;

use App\Helpers\General;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Modules\Sales\Commands\MenuPriceApproval\ApproveCommand;
use Modules\Sales\Commands\MenuPriceApproval\DeleteCommand;
use Modules\Sales\Commands\MenuPriceApproval\RejectCommand;
use Modules\Sales\Commands\MenuPriceApproval\StoreCommand;
use Modules\Sales\Commands\MenuPriceApproval\SubmitCommand;
use Modules\Sales\Commands\MenuPriceApproval\UpdateCommand;
use Modules\Sales\Models\MenuPriceApproval;
use Modules\Sales\Models\MenuPriceApprovalItem;

class MenuPriceApprovalController extends Controller
{
    public function index()
    {
        $params['items'] = MenuPriceApproval::latest('id')->get();
        return view('sales::menu_price_approval.index', $params);
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
        $params['item'] = MenuPriceApproval::find($id);
        return view('sales::menu_price_approval.edit', $params);
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
        $params['items'] = MenuPriceApproval::whereNotNull('submitted_at')
            ->whereNull('reviewed_by')->latest('id')->get();
        return view('sales::menu_price_approval.approval_view', $params);
    }

    public function approved()
    {
        $params['items'] = MenuPriceApproval::whereIsApproved(true)->latest('id')->get();
        return view('sales::menu_price_approval.approval_view', $params);
    }

    public function viewItems($id)
    {
        $params['items'] = MenuPriceApprovalItem::whereMenuPriceApprovalId($id)->get();
        return view('sales::menu_price_approval.items_view', $params);
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

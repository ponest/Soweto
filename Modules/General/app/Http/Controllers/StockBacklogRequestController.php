<?php

namespace Modules\General\Http\Controllers;

use App\Helpers\General;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Modules\Auth\Models\User;
use Modules\General\Commands\StockBacklog\ApproveCommand;
use Modules\General\Commands\StockBacklog\DeleteCommand;
use Modules\General\Commands\StockBacklog\RejectCommand;
use Modules\General\Commands\StockBacklog\StoreCommand;
use Modules\General\Commands\StockBacklog\SubmitCommand;
use Modules\General\Commands\StockBacklog\UpdateCommand;
use Modules\General\Models\StockBacklogRequest;

class StockBacklogRequestController extends Controller
{
    public function index()
    {
        $storeId = User::userStoreId();
        $params['items'] = StockBacklogRequest::whereStoreId($storeId)->latest('id')->get();
        return view('general::stock_backlog.index', $params);
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
        $params['item'] = StockBacklogRequest::find($id);
        return view('general::stock_backlog.edit', $params);
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

    public function approverView()
    {
        $params['items'] = StockBacklogRequest::whereNotNull('submitted_at')
            ->whereNull(['is_approved', 'reject_comments'])->latest('id')->get();
        return view('general::stock_backlog.approval_view', $params);
    }

    public function approveRequest($id)
    {
        $info = ApproveCommand::handle($id);
        $notification = General::customMessage($info['message'], $info['type']);
        return Redirect::back()->with($notification);
    }

    public function approved()
    {
        $params['items'] = StockBacklogRequest::whereIsApproved(true)->latest('id')->get();
        return view('general::stock_backlog.approved', $params);
    }

    public function rejectView($id)
    {
        $params['id'] = $id;
        return view('general::stock_backlog.reject_view', $params);
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
        $params['items'] = StockBacklogRequest::whereIsApproved(false)->latest('id')->get();
        return view('general::stock_backlog.rejected', $params);
    }

}

<?php

namespace Modules\Inventory\Http\Controllers;

use App\Helpers\General;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Redirect;
use Modules\Inventory\Commands\DisposalRequest\ApproveCommand;
use Modules\Inventory\Commands\DisposalRequest\DeleteCommand;
use Modules\Inventory\Commands\DisposalRequest\RejectCommand;
use Modules\Inventory\Commands\DisposalRequest\ReviewCommand;
use Modules\Inventory\Commands\DisposalRequest\StoreCommand;
use Modules\Inventory\Commands\DisposalRequest\SubmitCommand;
use Modules\Inventory\Commands\DisposalRequest\UpdateCommand;
use Modules\Inventory\Models\DisposalRequest;
use Modules\Inventory\Models\DisposalRequestItem;

class DisposalRequestController extends Controller
{

    public function index()
    {
        $params['items'] = DisposalRequest::latest('id')->get();
        return view('inventory::disposal_request.index', $params);
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
        $params['item'] = DisposalRequest::find($id);
        return view('inventory::disposal_request.edit', $params);
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
        if (Gate::allows('Manager')) {
            $params['items'] = DisposalRequest::whereNotNull('submitted_by')
                ->whereNull(['reject_comments', 'reviewed_by'])->latest('id')->get();
        } else if (Gate::allows('Director')) {
            $params['items'] = DisposalRequest::whereNotNull('reviewed_by')
                ->whereNull(['approved_by', 'reject_comments'])->latest('id')->get();
        }
        $params['approved_view'] = false;
        return view('inventory::disposal_request.approval_view', $params);
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
        $params['items'] = DisposalRequest::whereIsApproved(true)->latest('id')->get();
        return view('inventory::disposal_request.approved', $params);
    }

    public function viewItems($id)
    {
        $params['items'] = DisposalRequestItem::whereDisposalRequestId($id)->get();
        return view('inventory::disposal_request.items_view', $params);
    }

    public function rejectView($id)
    {
        $params['id'] = $id;
        return view('inventory::disposal_request.reject_view', $params);
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
        $params['items'] = DisposalRequest::whereIsApproved(false)->latest('id')->get();
        return view('inventory::disposal_request.rejected', $params);
    }
}

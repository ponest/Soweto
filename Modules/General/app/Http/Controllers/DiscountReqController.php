<?php

namespace Modules\General\Http\Controllers;

use App\Helpers\General;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Redirect;
use Modules\General\Commands\DiscountRequest\ApproveCommand;
use Modules\General\Commands\DiscountRequest\ReviewCommand;
use Modules\General\Commands\DiscountRequest\SubmitCommand;
use Modules\General\Models\DiscountReq;
use Modules\General\Commands\DiscountRequest\DeleteCommand;
use Modules\General\Commands\DiscountRequest\StoreCommand;
use Modules\General\Commands\DiscountRequest\UpdateCommand;
use Modules\HotelMgnt\Models\Client;

class DiscountReqController extends Controller
{
    public function index()
    {
        $params['items'] = DiscountReq::latest('id')->get();
        $params['clients'] = Client::orderBy('full_name')->get();
        return view('general::discount_request.index', $params);
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
        $params['item'] = DiscountReq::find($id);
        $params['clients'] = Client::orderBy('full_name')->get();
        return view('general::discount_request.edit', $params);
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
        if (Gate::allows('Manager')){
            $params['items'] = DiscountReq::whereNotNull('submitted_at')
                ->whereNull('reviewed_by')->latest('id')->get();
        }else{
            $params['items'] = DiscountReq::whereNotNull('reviewed_by')
                ->whereNull('approved_by')->latest('id')->get();
        }
        return view('general::discount_request.approval_view', $params);
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
        $params['items'] = DiscountReq::whereIsApproved(true)->latest('id')->get();
        return view('general::discount_request.approved', $params);
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

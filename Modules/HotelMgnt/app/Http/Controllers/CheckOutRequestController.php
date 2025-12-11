<?php

namespace Modules\HotelMgnt\Http\Controllers;

use App\Helpers\General;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Redirect;
use Modules\HotelMgnt\Commands\CheckOutRequest\SubmitCommand;
use Modules\HotelMgnt\Commands\CheckOutRequest\DeleteCommand;
use Modules\HotelMgnt\Commands\CheckOutRequest\UpdateCommand;
use Modules\HotelMgnt\Commands\CheckOutRequest\RejectCommand;
use Modules\HotelMgnt\Commands\CheckOutRequest\ApproveCommand;
use Modules\HotelMgnt\Commands\CheckOutRequest\ReviewCommand;
use Modules\HotelMgnt\Commands\CheckOutRequest\StoreCommand;
use Modules\HotelMgnt\Models\CheckOutRequest;

class CheckOutRequestController extends Controller
{
    public function index()
    {
        $params['items'] = CheckOutRequest::latest('id')->get();
        return view('hotelmgnt::checkout_request.index', $params);
    }

    public function create($id)
    {
        $params['booking_id'] = $id;
        return view('hotelmgnt::checkout_request.create', $params);
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->all();
        $info = StoreCommand::handle($data);
        $notification = General::customMessage($info['message'], $info['type']);
        return Redirect::back()->with($notification);
    }

    public function edit($id)
    {
        $params['item'] = CheckOutRequest::findOrFail($id);
        return view('hotelmgnt::checkout_request.edit', $params);
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
        if (Gate::allows('Manager')) {
            $params['items'] = CheckOutRequest::whereNotNull('submitted_at')
                ->whereNull('reviewed_by')->latest('id')->get();
        } else {
            $params['items'] = CheckOutRequest::whereNotNull('reviewed_by')
                ->whereNull(['approved_by', 'reject_comments'])->latest('id')->get();
        }
        return view('hotelmgnt::checkout_request.approval_view', $params);
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
        $params['items'] = CheckOutRequest::whereIsApproved(true)->latest('id')->get();
        return view('hotelmgnt::checkout_request.approved', $params);
    }

    public function rejectView($id)
    {
        $params['id'] = $id;
        return view('hotelmgnt::checkout_request.reject_view', $params);
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
        $params['items'] = CheckOutRequest::whereIsApproved(false)->latest('id')->get();
        return view('hotelmgnt::checkout_request.rejected', $params);
    }

}

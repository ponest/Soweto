<?php

namespace Modules\General\Http\Controllers;

use App\Helpers\General;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Redirect;
use Modules\General\Commands\DiscountRequest\ApproveCommand;
use Modules\General\Commands\DiscountRequest\RejectCommand;
use Modules\General\Commands\DiscountRequest\ReviewCommand;
use Modules\General\Commands\DiscountRequest\SubmitCommand;
use Modules\General\Models\DiscountReq;
use Modules\General\Commands\DiscountRequest\DeleteCommand;
use Modules\General\Commands\DiscountRequest\StoreCommand;
use Modules\General\Commands\DiscountRequest\UpdateCommand;
use Modules\General\Models\DiscountTransaction;
use Modules\HotelMgnt\Models\Client;
use Modules\HotelMgnt\Models\ClientWallet;
use Modules\HotelMgnt\Models\WalletTransaction;

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
                ->whereNull(['approved_by','reject_comments'])->latest('id')->get();
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
        return view('general::discount_request.reject_view', $params);
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
        $params['items'] = DiscountReq::whereIsApproved(false)->latest('id')->get();
        return view('general::discount_request.rejected', $params);
    }

    public function getDiscountDetails(Request $request)
    {
        $discount = DiscountReq::whereIsApproved(true)->where('discount_code',$request->discount_code)->first();
        if ($discount) {
            $total_transaction = DiscountTransaction::where('discount_id', $discount->id)->sum('amount');
            $balance = $discount->discount_amount - $total_transaction;
            $discount_amount = $discount->discount_amount;
            return response()->json([
                'success' => true,
                'message' => 'Discount Successfully Found',
                'balance' => $balance,
                'total_transaction' => $total_transaction,
                'discount_amount' => $discount_amount,
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Discount not found'
            ]);
        }
    }
}

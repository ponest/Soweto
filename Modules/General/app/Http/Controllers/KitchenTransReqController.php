<?php

namespace Modules\General\Http\Controllers;

use App\Helpers\General;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Redirect;
use Modules\General\Commands\KitchenTransRequest\ApproveCommand;
use Modules\General\Commands\KitchenTransRequest\DeleteCommand;
use Modules\General\Commands\KitchenTransRequest\RejectCommand;
use Modules\General\Commands\KitchenTransRequest\StoreCommand;
use Modules\General\Commands\KitchenTransRequest\SubmitCommand;
use Modules\General\Commands\KitchenTransRequest\UpdateCommand;
use Modules\General\Models\KitchenTransReq;

class KitchenTransReqController extends Controller
{
    public function index()
    {
        $params['items'] = KitchenTransReq::latest('id')->get();
        return view('general::kitchen_trans_req.index', $params);
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
        $params['item'] = KitchenTransReq::find($id);
        return view('general::kitchen_trans_req.edit', $params);
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
            $params['items'] = KitchenTransReq::whereNotNull('submitted_at')
                ->whereNull('reviewed_by')->latest('id')->get();
        }
        return view('general::kitchen_trans_req.approval_view', $params);
    }

//    public function reviewRequest($id)
//    {
//        $info = ReviewCommand::handle($id);
//        $notification = General::customMessage($info['message'], $info['type']);
//        return Redirect::back()->with($notification);
//    }

    public function approveRequest($id)
    {
        $info = ApproveCommand::handle($id);
        $notification = General::customMessage($info['message'], $info['type']);
        return Redirect::back()->with($notification);
    }

    public function approved()
    {
        $params['items'] = KitchenTransReq::whereIsApproved(true)->latest('id')->get();
        return view('general::kitchen_trans_req.approved', $params);
    }

    public function rejectView($id)
    {
        $params['id'] = $id;
        return view('general::kitchen_trans_req.reject_view', $params);
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
        $params['items'] = KitchenTransReq::whereIsApproved(false)->latest('id')->get();
        return view('general::kitchen_trans_req.rejected', $params);
    }

//    public function getDiscountDetails(Request $request)
//    {
//        $discount = DiscountReq::whereIsApproved(true)->where('discount_code',$request->discount_code)->first();
//        if ($discount) {
//            $total_transaction = DiscountTransaction::where('discount_id', $discount->id)->sum('amount');
//            $balance = $discount->discount_amount - $total_transaction;
//            $discount_amount = $discount->discount_amount;
//            return response()->json([
//                'success' => true,
//                'message' => 'Discount Successfully Found',
//                'balance' => $balance,
//                'total_transaction' => $total_transaction,
//                'discount_amount' => $discount_amount,
//            ]);
//        } else {
//            return response()->json([
//                'success' => false,
//                'message' => 'Discount not found'
//            ]);
//        }
//    }
}

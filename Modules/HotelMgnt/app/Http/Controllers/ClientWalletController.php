<?php

namespace Modules\HotelMgnt\Http\Controllers;

use App\Helpers\General;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Modules\HotelMgnt\Commands\ClientWallet\ApproveCommand;
use Modules\HotelMgnt\Commands\ClientWallet\DeleteCommand;
use Modules\HotelMgnt\Commands\ClientWallet\RejectCommand;
use Modules\HotelMgnt\Commands\ClientWallet\StoreCommand;
use Modules\HotelMgnt\Commands\ClientWallet\SubmitCommand;
use Modules\HotelMgnt\Commands\ClientWallet\UpdateCommand;
use Modules\HotelMgnt\Models\Client;
use Modules\HotelMgnt\Models\ClientWallet;
use Modules\HotelMgnt\Models\WalletTransaction;
use Modules\Setups\Models\PaymentMethod;

class ClientWalletController extends Controller
{

    public function index()
    {
        $params['items'] = ClientWallet::all();
        $params['clients'] = Client::orderBy('full_name')->get();
        $params['payment_methods'] = PaymentMethod::orderBy('name')->get();
        return view('hotelmgnt::client_wallet.index', $params);
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
        $params['item'] = ClientWallet::find($id);
        $params['clients'] = Client::orderBy('full_name')->get();
        $params['payment_methods'] = PaymentMethod::orderBy('name')->get();
        return view('hotelmgnt::client_wallet.edit', $params);
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
        $params['items'] = ClientWallet::whereNotNull('submitted_at')
            ->whereNull('reviewed_by')->latest('id')->get();
        $params['approved_view'] = false;
        return view('hotelmgnt::client_wallet.approval_view', $params);
    }

    public function approveRequest($id)
    {
        $info = ApproveCommand::handle($id);
        $notification = General::customMessage($info['message'], $info['type']);
        return Redirect::back()->with($notification);
    }

    public function approved()
    {
        $params['items'] = ClientWallet::whereIsApproved(true)->latest('id')->get();
        $params['approved_view'] = true;
        return view('hotelmgnt::client_wallet.approval_view', $params);
    }

    public function rejectView($id)
    {
        $params['id'] = $id;
        return view('hotelmgnt::client_wallet.reject_view', $params);
    }

    public function rejectRequest(Request $request)
    {
        $data = $request->all();
        $id = $data['id'];
        $info = RejectCommand::handle($id, $data);
        $notification = General::customMessage($info['message'], $info['type']);
        return Redirect::back()->with($notification);
    }

    public function getWalletDetails(Request $request)
    {
        $wallet = ClientWallet::whereReferenceNo($request->reference_no)
            ->where('is_approved',true)->first();
        if ($wallet) {
            $total_transaction = WalletTransaction::where('wallet_id', $wallet->id)->sum('amount');
            $balance = $wallet->wallet_amount - $total_transaction;
            $wallet_amount = $wallet->wallet_amount;
            return response()->json([
                'success' => true,
                'message' => 'Wallet Successfully Found',
                'balance' => $balance,
                'total_transaction' => $total_transaction,
                'wallet_amount' => $wallet_amount,
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Wallet not found'
            ]);
        }
    }
}

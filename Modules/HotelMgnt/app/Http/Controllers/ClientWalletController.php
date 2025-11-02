<?php

namespace Modules\HotelMgnt\Http\Controllers;

use App\Helpers\General;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Modules\HotelMgnt\Commands\ClientWallet\DeleteCommand;
use Modules\HotelMgnt\Commands\ClientWallet\StoreCommand;
use Modules\HotelMgnt\Commands\ClientWallet\UpdateCommand;
use Modules\HotelMgnt\Models\Client;
use Modules\HotelMgnt\Models\ClientWallet;

class ClientWalletController extends Controller
{

    public function index()
    {
        $params['items'] = ClientWallet::all();
        $params['clients'] = Client::orderBy('full_name')->get();
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
}

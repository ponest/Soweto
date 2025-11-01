<?php

namespace Modules\HotelMgnt\Http\Controllers;

use App\Helpers\General;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Modules\HotelMgnt\Commands\Client\DeleteCommand;
use Modules\HotelMgnt\Commands\Client\StoreCommand;
use Modules\HotelMgnt\Commands\Client\UpdateCommand;
use Modules\HotelMgnt\Models\Client;
use Modules\Setups\Models\Institution;

class ClientsController extends Controller
{
    public function index()
    {
        $params['items'] = Client::latest('id')->get();
        $params['institutions'] = Institution::orderBy('name')->get();
        return view('hotelmgnt::clients.index', $params);
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
        $params['item'] = Client::find($id);
        return view('hotelmgnt::clients.edit', $params);
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

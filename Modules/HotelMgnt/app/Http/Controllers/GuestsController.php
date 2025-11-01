<?php

namespace Modules\HotelMgnt\Http\Controllers;

use App\Helpers\General;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Modules\HotelMgnt\Commands\Guest\DeleteCommand;
use Modules\HotelMgnt\Commands\Guest\StoreCommand;
use Modules\HotelMgnt\Commands\Guest\UpdateCommand;
use Modules\HotelMgnt\Models\Guest;
use Modules\Setups\Models\IdentityType;

class GuestsController extends Controller
{
    public function index()
    {
        $params['items'] = Guest::latest('id')->get();
        $params['id_types'] = IdentityType::orderBy('name')->get();
        $params['genders'] = array("Male", "Female");
        return view('hotelmgnt::guests.index', $params);
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
        $params['item'] = Guest::find($id);
        $params['id_types'] = IdentityType::orderBy('name')->get();
        $params['genders'] = array("Male", "Female");
        return view('hotelmgnt::guests.edit', $params);
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

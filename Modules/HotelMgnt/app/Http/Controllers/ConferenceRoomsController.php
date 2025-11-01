<?php

namespace Modules\HotelMgnt\Http\Controllers;

use App\Helpers\General;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Modules\HotelMgnt\Commands\ConferenceRoom\DeleteCommand;
use Modules\HotelMgnt\Commands\ConferenceRoom\StoreCommand;
use Modules\HotelMgnt\Commands\ConferenceRoom\UpdateCommand;
use Modules\HotelMgnt\Models\ConferenceRoom;

class ConferenceRoomsController extends Controller
{
    public function index()
    {
        $params['items'] = ConferenceRoom::latest('id')->get();
        return view('hotelmgnt::conference_rooms.index', $params);
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
        $params['item'] = ConferenceRoom::find($id);
        return view('hotelmgnt::conference_rooms.edit', $params);
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

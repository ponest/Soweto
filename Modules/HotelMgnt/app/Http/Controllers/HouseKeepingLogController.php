<?php

namespace Modules\HotelMgnt\Http\Controllers;

use App\Helpers\General;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Modules\General\Models\Staff;
use Modules\HotelMgnt\Commands\HouseKeepingLog\DeleteCommand;
use Modules\HotelMgnt\Commands\HouseKeepingLog\StoreCommand;
use Modules\HotelMgnt\Commands\HouseKeepingLog\UpdateCommand;
use Modules\HotelMgnt\Models\HouseKeepingLog;
use Modules\HotelMgnt\Models\Room;

class HouseKeepingLogController extends Controller
{
    public function index()
    {
        $params['items'] = HouseKeepingLog::latest('id')->get();
        $params['rooms'] = Room::orderBy('room_number')->get();
        $params['staffs'] = Staff::orderBy('first_name')->get();
        return view('hotelmgnt::house_keeping_logs.index', $params);
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
        $params['item'] = HouseKeepingLog::find($id);
        $params['rooms'] = Room::orderBy('room_number')->get();
        $params['staffs'] = Staff::orderBy('first_name')->get();
        return view('hotelmgnt::house_keeping_logs.edit', $params);
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

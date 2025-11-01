<?php

namespace Modules\HotelMgnt\Http\Controllers;

use App\Helpers\General;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Modules\HotelMgnt\Commands\RoomType\DeleteCommand;
use Modules\HotelMgnt\Commands\RoomType\StoreCommand;
use Modules\HotelMgnt\Commands\RoomType\UpdateCommand;
use Modules\HotelMgnt\Models\RoomType;

class RoomTypesController extends Controller
{
    public function index()
    {
        $params['items'] = RoomType::latest('id')->get();
        return view('hotelmgnt::room_types.index', $params);
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
        $params['item'] = RoomType::find($id);
        return view('hotelmgnt::room_types.edit', $params);
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

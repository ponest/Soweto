<?php

namespace Modules\HotelMgnt\Http\Controllers;

use App\Enums\GeneralEnum;
use App\Enums\StockOutCategories;
use App\Helpers\General;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use Modules\HotelMgnt\Commands\Room\DeleteCommand;
use Modules\HotelMgnt\Commands\Room\StoreCommand;
use Modules\HotelMgnt\Commands\Room\UpdateCommand;
use Modules\HotelMgnt\Models\Room;
use Modules\HotelMgnt\Models\RoomItem;
use Modules\HotelMgnt\Models\RoomType;
use Modules\Sales\Commands\Sales\SaveStockOutCommand;

class RoomsController extends Controller
{
    public function index()
    {
        $params['items'] = Room::latest('id')->get();
        $params['room_types'] = RoomType::orderBy('name')->get();
        return view('hotelmgnt::rooms.index', $params);
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
        $params['item'] = Room::find($id);
        $params['room_types'] = RoomType::orderBy('name')->get();
        return view('hotelmgnt::rooms.edit', $params);
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

    public function getRoomsByStatus($status)
    {
        $params['items'] = Room::where('status',$status)->orderBy('room_number')->get();
        $params['header'] = $status." Rooms";
        $params['status'] = $status;
        return view('hotelmgnt::rooms.room_by_status', $params);
    }

}

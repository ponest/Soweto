<?php

namespace Modules\HotelMgnt\Http\Controllers;

use App\Helpers\General;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Modules\HotelMgnt\Commands\RoomItem\DeleteCommand;
use Modules\HotelMgnt\Commands\RoomItem\StoreCommand;
use Modules\HotelMgnt\Commands\RoomItem\UpdateCommand;
use Modules\HotelMgnt\Models\RoomItem;
use Modules\Inventory\Models\StockItem;

class RoomItemController extends Controller
{
    public function index($id)
    {
        $params['items'] = RoomItem::whereRoomId($id)->latest('id')->get();
        $params['stock_items'] = StockItem::orderBy('name')->get();
        $params['id'] = $id;
        return view('hotelmgnt::room_items.index', $params);
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
        $params['item'] = RoomItem::find($id);
        $params['stock_items'] = StockItem::orderBy('name')->get();
        return view('hotelmgnt::room_items.edit', $params);
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

<?php

namespace Modules\HotelMgnt\Http\Controllers;

use App\Helpers\General;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Modules\HotelMgnt\Commands\Booking\CancelBookingCommand;
use Modules\HotelMgnt\Commands\Booking\CheckInCommand;
use Modules\HotelMgnt\Commands\Booking\CheckOutCommand;
use Modules\HotelMgnt\Commands\Booking\DeleteCommand;
use Modules\HotelMgnt\Commands\Booking\StoreCommand;
use Modules\HotelMgnt\Commands\Booking\UpdateCommand;
use Modules\HotelMgnt\Models\Booking;
use Modules\HotelMgnt\Models\Guest;
use Modules\HotelMgnt\Models\Room;

class BookingsController extends Controller
{
    public function index()
    {
        $params['items'] = Booking::latest('id')->get();
        $params['guests'] = Guest::orderBy('full_name')->get();
        $params['rooms'] = Room::orderBy('room_number')->get();
        return view('hotelmgnt::bookings.index', $params);
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
        $params['item'] = Booking::find($id);
        $params['guests'] = Guest::orderBy('full_name')->get();
        $params['rooms'] = Room::orderBy('room_number')->get();
        return view('hotelmgnt::bookings.edit', $params);
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

    public function checkIn($id)
    {
        $info = CheckInCommand::handle($id);
        $notification = General::customMessage($info['message'], $info['type']);
        return Redirect::back()->with($notification);
    }

    public function checkOut($id)
    {
        $info = CheckOutCommand::handle($id);
        $notification = General::customMessage($info['message'], $info['type']);
        return Redirect::back()->with($notification);
    }

    public function cancelView($id)
    {
        $params['item'] = Booking::find($id);
        return view('hotelmgnt::bookings.cancel', $params);
    }

    public function cancelReservation(Request $request)
    {
        $data = $request->all();
        $info = CancelBookingCommand::handle($data);
        $notification = General::customMessage($info['message'], $info['type']);
        return Redirect::back()->with($notification);
    }
}

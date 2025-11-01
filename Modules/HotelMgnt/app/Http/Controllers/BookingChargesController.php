<?php

namespace Modules\HotelMgnt\Http\Controllers;

use App\Helpers\General;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Modules\HotelMgnt\Commands\BookingCharges\DeleteCommand;
use Modules\HotelMgnt\Commands\BookingCharges\StoreCommand;
use Modules\HotelMgnt\Commands\BookingCharges\UpdateCommand;
use Modules\HotelMgnt\Models\BookingCharges;

class BookingChargesController extends Controller
{

    public function index($id)
    {
        $params['items'] = BookingCharges::whereBookingId($id)->get();
        $params['types'] = array('Laundry','Ironing','Swimming');
        $params['booking_id'] = $id;
        return view('hotelmgnt::booking_charges.index', $params);
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
        $params['item'] = BookingCharges::find($id);
        $params['types'] = array('Laundry','Ironing','Swimming');
        return view('hotelmgnt::booking_charges.edit', $params);
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

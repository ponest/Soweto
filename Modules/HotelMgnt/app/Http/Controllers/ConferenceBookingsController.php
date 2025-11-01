<?php

namespace Modules\HotelMgnt\Http\Controllers;

use App\Helpers\General;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Modules\HotelMgnt\Models\ConferenceBooking;
use Modules\Setups\Commands\Department\DeleteCommand;
use Modules\Setups\Commands\Department\StoreCommand;
use Modules\Setups\Commands\Department\UpdateCommand;
use Modules\Setups\Models\Department;

class ConferenceBookingsController extends Controller
{
    public function index()
    {
        $params['items'] = ConferenceBooking::latest('id')->get();
        return view('hotelmgnt::conference_bookings.index', $params);
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
        $params['item'] = Department::find($id);
        return view('setups::departments.edit', $params);
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

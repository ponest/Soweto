<?php

namespace Modules\HotelMgnt\Http\Controllers;

use App\Helpers\General;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Modules\HotelMgnt\Commands\BookingCharges\DeleteCommand;
use Modules\HotelMgnt\Commands\BookingCharges\StoreCommand;
use Modules\HotelMgnt\Commands\BookingCharges\UpdateCommand;
use Modules\HotelMgnt\Models\BookingCharges;
use Modules\HotelMgnt\Models\BookingRoomHistory;
use Modules\Sales\Models\Bill;

class BookingChargesController extends Controller
{
    public function index($id)
    {
        $params['items'] = BookingCharges::whereBookingId($id)->latest('id')->get();
        $params['types'] = array('Laundry', 'Ironing', 'Swimming');
        $params['booking_id'] = $id;
        $params['bill'] = Bill::where('booking_id', $id)->first();
        $params['partial'] = $this->calculateRoomCharges($id);
        return view('hotelmgnt::booking_charges.index', $params);
    }

    public function calculateRoomCharges($booking_id)
    {
        $bookingHistories = BookingRoomHistory::where([['booking_id', $booking_id], ['is_billed', false]])->get();
        $totalRoomCost = 0;

        $responses = [];

        foreach ($bookingHistories as $stay) {
            $start_date = Carbon::parse($stay->start_date);
            $end_date = Carbon::parse($stay->end_date);
            $days = $stay->end_date
                ? $start_date->diffInDays($end_date)
                : $start_date->diffInDays(Carbon::today());

            $now = Carbon::now();
            $checkoutTime = $now->format('H:i');

            // Additional charge based on time
            $additional = 0;

            if ($checkoutTime >= '11:00' && $checkoutTime < '13:00') {
                $additional = 0.5; // half-day
            } elseif ($checkoutTime >= '13:00') {
                $additional = 1; // full extra day
            }

            $chargeableDays = $days + $additional;

            $totalRoomCost += $chargeableDays * $stay->rate;
            $responses[] = [
                'days' => $chargeableDays,
                'totalRoomCost' => $totalRoomCost,
                'rate' => $stay->rate
            ];
        }
        return $responses;
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $info = StoreCommand::handle($data);
        $notification = General::customMessage($info['message'], $info['type']);
        return Redirect::back()->with($notification);
    }

    public function show($bookingId)
    {
        $params['items'] = BookingCharges::whereBookingId($bookingId)->get();
        $params['total_price'] = BookingCharges::whereBookingId($bookingId)->sum('total_price');
        return view('hotelmgnt::booking_charges.show', $params);
    }


    public function edit($id)
    {
        $params['item'] = BookingCharges::find($id);
        $params['types'] = array('Laundry', 'Ironing', 'Swimming');
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

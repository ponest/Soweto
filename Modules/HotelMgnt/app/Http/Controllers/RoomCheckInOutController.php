<?php

namespace Modules\HotelMgnt\Http\Controllers;

use App\Helpers\General;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Modules\HotelMgnt\Commands\CheckInOut\CheckInCommand;
use Modules\HotelMgnt\Commands\CheckInOut\CheckOutCommand;
use Modules\HotelMgnt\Commands\CheckInOut\ComputeBillCommand;
use Modules\HotelMgnt\Commands\CheckInOut\ConfirmPaymentCommand;
use Modules\HotelMgnt\Commands\CheckInOut\TransferRoomCommand;
use Modules\HotelMgnt\Models\Booking;
use Modules\HotelMgnt\Models\Room;
use Modules\HotelMgnt\Models\RoomCheckInOut;
use Modules\Sales\Models\Bill;
use Modules\Sales\Models\BillItem;
use Barryvdh\DomPDF\Facade\Pdf;
use Modules\Setups\Models\PaymentMethod;

class RoomCheckInOutController extends Controller
{
    public function index()
    {
        $params['items'] = RoomCheckInOut::latest('id')->limit(500)->get();
        $params['bookings'] = Booking::whereBookingStatus('Reserved')->get();
        return view('hotelmgnt::check_in_out.index', $params);
    }

    public function checkIn(Request $request)
    {
        $data = $request->all();
        $info = CheckInCommand::handle($data);
        $notification = General::customMessage($info['message'], $info['type']);
        return Redirect::back()->with($notification);
    }

    public function transferRoomView($id)
    {
        $params['item'] = RoomCheckInOut::find($id);
        $params['rooms'] = Room::where('status','Available')->get();
        return view('hotelmgnt::check_in_out.transfer', $params);
    }

    public function transferRoom(Request $request)
    {
        $data = $request->all();
        $info = TransferRoomCommand::handle($data);
        $notification = General::customMessage($info['message'], $info['type']);
        return Redirect::back()->with($notification);
    }
    public function checkOut($id)
    {
        $info = CheckOutCommand::handle($id);
        $notification = General::customMessage($info['message'], $info['type']);
        return Redirect::back()->with($notification);
    }

    public function computeBill($id){
        $info = ComputeBillCommand::handle($id);
        $notification = General::customMessage($info['message'], $info['type']);
        return Redirect::back()->with($notification);
    }

    public function downloadBill($id)
    {
        $params['bill_items'] = BillItem::join('bills', 'bills.id', '=', 'bill_items.bill_id')
            ->where('bills.booking_id', $id)->select('bill_items.*')->get();
        $pdf = PDF::loadView('hotelmgnt::bookings.bill_pdf', $params);
        return $pdf->download("Bill" . '.pdf');
    }

    public function confirmPaymentView($id){
        $params['item'] = RoomCheckInOut::find($id);
        $params['payment_methods'] = PaymentMethod::orderBy('name')->get();
        $params['bill_amount'] = Bill::where('booking_id', $params['item']->booking_id)->sum('bill_amount');
        return view('hotelmgnt::check_in_out.payment_conf', $params);
    }

    public function confirmPayment(Request $request)
    {
        $data = $request->all();
        $info = ConfirmPaymentCommand::handle($data);
        $notification = General::customMessage($info['message'], $info['type']);
        return Redirect::back()->with($notification);
    }
}

<?php

namespace Modules\Setups\Http\Controllers;

use App\Helpers\General;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Modules\Setups\Commands\PaymentMethod\DeleteCommand;
use Modules\Setups\Commands\PaymentMethod\StoreCommand;
use Modules\Setups\Commands\PaymentMethod\UpdateCommand;
use Modules\Setups\Models\PaymentMethod;

class PaymentMethodController extends Controller
{

    public function index()
    {
        $params['items'] = PaymentMethod::orderBy('name')->get();
        return view('setups::payment_methods.index',$params);
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
        $params['item'] = PaymentMethod::find($id);
        return view('setups::payment_methods.edit', $params);
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

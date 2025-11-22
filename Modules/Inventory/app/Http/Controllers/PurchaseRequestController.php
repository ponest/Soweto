<?php

namespace Modules\Inventory\Http\Controllers;

use App\Helpers\General;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Modules\Inventory\Commands\PurchaseRequest\StoreCommand;
use Modules\Inventory\Commands\PurchaseRequest\SubmitCommand;
use Modules\Inventory\Commands\PurchaseRequest\UpdateCommand;
use Modules\Inventory\Models\PurchaseRequest;

class PurchaseRequestController extends Controller
{

    public function index()
    {
        $params['items'] = PurchaseRequest::latest('id')->get();
        return view('inventory::purchase_request.index', $params);
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
        $params['item'] = PurchaseRequest::find($id);
        return view('inventory::purchase_request.edit', $params);
    }

    public function update(Request $request, $id)
    {
        $data = $request->all();
        $info = UpdateCommand::handle($data, $id);
        $notification = General::customMessage($info['message'], $info['type']);
        return Redirect::back()->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
    }

    public function submitRequest($id)
    {
        $info = SubmitCommand::handle($id);
        $notification = General::customMessage($info['message'], $info['type']);
        return Redirect::back()->with($notification);
    }
}

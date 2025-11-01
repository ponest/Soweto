<?php

namespace Modules\Setups\Http\Controllers;

use App\Helpers\General;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Modules\Setups\Commands\IdentityType\DeleteCommand;
use Modules\Setups\Commands\IdentityType\StoreCommand;
use Modules\Setups\Commands\IdentityType\UpdateCommand;
use Modules\Setups\Models\IdentityType;

class IdentityTypesController extends Controller
{
    public function index()
    {
        $params['items'] = IdentityType::latest('id')->get();
        return view('setups::identity_types.index', $params);
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
        $params['item'] = IdentityType::find($id);
        return view('setups::identity_types.edit', $params);
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

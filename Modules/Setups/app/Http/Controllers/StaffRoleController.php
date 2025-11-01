<?php

namespace Modules\Setups\Http\Controllers;

use App\Helpers\General;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Modules\Setups\Commands\StaffRole\DeleteCommand;
use Modules\Setups\Commands\StaffRole\StoreCommand;
use Modules\Setups\Commands\StaffRole\UpdateCommand;
use Modules\Setups\Models\StaffRole;

class StaffRoleController extends Controller
{
    public function index()
    {
        $params['items'] = StaffRole::latest('id')->get();
        return view('setups::staff_roles.index', $params);
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
        $params['item'] = StaffRole::find($id);
        return view('setups::staff_roles.edit', $params);
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

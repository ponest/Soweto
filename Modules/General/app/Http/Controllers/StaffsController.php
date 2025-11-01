<?php

namespace Modules\General\Http\Controllers;

use App\Helpers\General;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Modules\General\Commands\Staff\DeleteCommand;
use Modules\General\Commands\Staff\StoreCommand;
use Modules\General\Commands\Staff\UpdateCommand;
use Modules\General\Models\Staff;
use Modules\Setups\Models\StaffRole;

class StaffsController extends Controller
{
    public function index()
    {
        $params['items'] = Staff::latest('id')->get();
        $params['gender'] = array("Male", "Female");
        $params['staff_roles'] = StaffRole::orderBy('name')->get();
        return view('general::staffs.index', $params);
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
        $params['item'] = Staff::find($id);
        $params['gender'] = array("Male", "Female");
        $params['staff_roles'] = StaffRole::orderBy('name')->get();
        return view('general::staffs.edit', $params);
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

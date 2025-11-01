<?php

namespace Modules\Setups\Http\Controllers;

use App\Helpers\General;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Modules\Setups\Commands\Department\DeleteCommand;
use Modules\Setups\Commands\Department\StoreCommand;
use Modules\Setups\Commands\Department\UpdateCommand;
use Modules\Setups\Models\Department;

class DepartmentController extends Controller
{
    public function index()
    {
        $params['items'] = Department::latest('id')->get();
        return view('setups::departments.index', $params);
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

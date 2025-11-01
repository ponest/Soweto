<?php

namespace Modules\Auth\Http\Controllers;

use App\Helpers\General;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Modules\Auth\Commands\Roles\DeleteCommand;
use Modules\Auth\Commands\Roles\StoreCommand;
use Modules\Auth\Commands\Roles\UpdateCommand;
use Modules\Auth\Models\Role;

class RolesController extends Controller
{
    public function index()
    {
        $params['items'] = Role::latest('id')->get();
        return view('auth::roles.index', $params);
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
        $params['item'] = Role::find($id);
        return view('auth::roles.edit', $params);
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

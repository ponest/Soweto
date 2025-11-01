<?php

namespace Modules\Auth\Http\Controllers;

use App\Helpers\General;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Modules\Auth\Commands\Users\ResetPasswordCommand;
use Modules\Auth\Commands\Users\StoreCommand;
use Modules\Auth\Commands\Users\UpdateCommand;
use Modules\Auth\Models\Role;
use Modules\Auth\Models\RoleUser;
use Modules\Auth\Models\User;
use Modules\Inventory\Models\Store;
use Modules\Setups\Models\Department;

class UsersController extends Controller
{
    public function index()
    {
        $params['items'] = User::latest('id')->get();
        $params['roles'] = Role::orderBy('name')->get();
        $params['departments'] = Department::orderBy('name')->get();
        $params['stores'] = Store::orderBy('name')->get();
        return view('auth::users.index', $params);
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $info = StoreCommand::handle($data);
        $notification = General::customMessage($info['message'], $info['type']);
        return Redirect::back()->with($notification);
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        return view('setups::show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $params['item'] = User::find($id);
        $params['roles'] = Role::orderBy('name')->get();
        $params['selected_roles'] = RoleUser::where('user_id', $id)->pluck('role_id')->toArray();
        $params['departments'] = Department::orderBy('name')->get();
        $params['stores'] = Store::orderBy('name')->get();
        return view('auth::users.edit', $params);
    }


    public function update(Request $request, $id)
    {
        $data = $request->all();
        $info = UpdateCommand::handle($data, $id);
        $notification = General::customMessage($info['message'], $info['type']);
        return Redirect::back()->with($notification);
    }

    public function reset($id)
    {
        $info = ResetPasswordCommand::handle($id);
        $notification = General::customMessage($info['message'], $info['type']);
        return Redirect::back()->with($notification);
    }

    public function destroy($id)
    {
    }
}

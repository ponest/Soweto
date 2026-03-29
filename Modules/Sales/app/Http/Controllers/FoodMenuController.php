<?php

namespace Modules\Sales\Http\Controllers;

use App\Helpers\General;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Modules\Sales\Commands\FoodMenu\DeleteCommand;
use Modules\Sales\Commands\FoodMenu\StoreCommand;
use Modules\Sales\Commands\FoodMenu\UpdateCommand;
use Modules\Sales\Models\FoodMenu;

class FoodMenuController extends Controller
{
    public function index()
    {
        $params['items'] = FoodMenu::latest('id')->get();
        $params['is_company'] = [['value'=>0, 'text'=>'No'],['value'=>1, 'text'=>'Yes']];
        $params['has_company'] = [['value'=>0, 'text'=>'No'],['value'=>1, 'text'=>'Yes']];
        return view('sales::food_menu.index', $params);
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
        $params['item'] = FoodMenu::find($id);
        $params['is_company'] = [['value'=>0, 'text'=>'No'],['value'=>1, 'text'=>'Yes']];
        $params['has_company'] = [['value'=>0, 'text'=>'No'],['value'=>1, 'text'=>'Yes']];
        return view('sales::food_menu.edit', $params);
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

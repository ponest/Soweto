<?php

namespace Modules\General\Http\Controllers;

use App\Helpers\General;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Modules\General\Commands\Ingredient\DeleteCommand;
use Modules\General\Commands\Ingredient\StoreCommand;
use Modules\General\Commands\Ingredient\UpdateCommand;
use Modules\General\Models\Ingredient;
use Modules\Inventory\Models\StockItem;
use Modules\Sales\Models\FoodMenu;

class IngredientController extends Controller
{
    public function index($id)
    {
        $params['items'] = Ingredient::where('menu_id',$id)->latest('id')->get();
        $params['stock_items'] = StockItem::orderBy('name')->get();
        $params['menu_id'] = $id;
        $params['food_menu'] = FoodMenu::findOrFail($id);
        return view('general::ingredients.index', $params);
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
        $params['item'] = Ingredient::find($id);
        $params['stock_items'] = StockItem::orderBy('name')->get();
        return view('general::ingredients.edit', $params);
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

<?php

namespace Modules\General\Http\Controllers;

use App\Enums\GeneralEnum;
use App\Helpers\General;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Modules\General\Commands\KitchenTransItem\DeleteCommand;
use Modules\General\Commands\KitchenTransItem\StoreCommand;
use Modules\General\Models\KitchenTransReq;
use Modules\General\Models\KitchenTransReqItem;
use Modules\Inventory\Models\StockItem;
use Modules\Inventory\Models\StoreItem;

class KitchenTransReqItemController extends Controller
{
    public function index($id)
    {
        $params['items'] = KitchenTransReqItem::whereKitchenTransReqId($id)->latest('id')->get();
        $itemIds = StoreItem::whereStoreId(GeneralEnum::KitchenStoreId)->pluck('item_id');
        $params['stock_items'] = StockItem::whereIn('id',$itemIds)->get();
        $params['requisition'] = KitchenTransReq::find($id);
        return view('general::kitchen_trans_req_item.index', $params);
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $info = StoreCommand::handle($data);
        $notification = General::customMessage($info['message'], $info['type']);
        return Redirect::back()->with($notification);
    }


    public function destroy($id)
    {
        $info = DeleteCommand::handle($id);
        $notification = General::customMessage($info['message'], $info['type']);
        return Redirect::back()->with($notification);
    }

    public function show($id)
    {
        $params['items'] = KitchenTransReqItem::whereKitchenTransReqId($id)->get();
        return view('general::kitchen_trans_req.items_view', $params);
    }
}

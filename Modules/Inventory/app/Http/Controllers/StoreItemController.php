<?php

namespace Modules\Inventory\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\Auth\Models\User;
use Modules\Inventory\Models\StoreItem;

class StoreItemController extends Controller
{
    public function stockBalance()
    {
        $storeId = User::userStoreId();
        $params['items'] = StoreItem::whereStoreId($storeId)->latest()->get();
        return view('inventory::store_item.stock_balance', $params);
    }
}

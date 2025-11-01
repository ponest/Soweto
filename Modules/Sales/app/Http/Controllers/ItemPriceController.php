<?php

namespace Modules\Sales\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\Sales\Models\ItemPrice;
use Modules\Sales\Models\MenuPrice;

class ItemPriceController extends Controller
{

    public function index()
    {
        $params['items'] = ItemPrice::whereIsActive(true)->get();
        return view('sales::price.item_price', $params);
    }

    public function getPriceByItem($itemId, $category)
    {
        $model = match ($category) {
            'bar' => ItemPrice::class,
            'kitchen' => MenuPrice::class,
            default => null,
        };

        if (!$model) {
            return response()->json(['success' => false, 'message' => 'Invalid category']);
        }

        $column = $category === 'bar' ? 'item_id' : 'menu_id';

        $price = $model::where($column, $itemId)
            ->where('is_active', true)
            ->value('price');

        return response()->json([
            'success' => (bool) $price,
            'price' => $price,
            'message' => $price ? null : 'Item price not found'
        ]);
    }
}

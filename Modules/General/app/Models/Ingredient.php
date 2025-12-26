<?php

namespace Modules\General\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Inventory\Models\StockItem;
use Modules\Setups\Models\Unit;

class Ingredient extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    public static function isExist($menu_id, $stock_item_id)
    {
        return Ingredient:: where([['menu_id', $menu_id], ['stock_item_id', $stock_item_id]])->first();
    }

    public static function isExistOnEdit($menu_id, $stock_item_id, $id)
    {
        return Ingredient::where([['menu_id', $menu_id], ['stock_item_id', $stock_item_id], ['id', '!=', $id]])->first();
    }

    public function stockItem(): BelongsTo
    {
        return $this->belongsTo(StockItem::class);
    }

    public function unit(): BelongsTo
    {
        return $this->belongsTo(Unit::class);
    }
}

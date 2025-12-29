<?php

namespace Modules\General\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;
use Modules\Inventory\Models\StockItem;
use Modules\Setups\Models\Unit;

/**
 * 
 *
 * @property int $id
 * @property int $menu_id
 * @property int $stock_item_id
 * @property float $quantity
 * @property int $unit_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Carbon|null $deleted_at
 * @property-read StockItem $stockItem
 * @property-read Unit $unit
 * @method static Builder<static>|Ingredient newModelQuery()
 * @method static Builder<static>|Ingredient newQuery()
 * @method static Builder<static>|Ingredient onlyTrashed()
 * @method static Builder<static>|Ingredient query()
 * @method static Builder<static>|Ingredient whereCreatedAt($value)
 * @method static Builder<static>|Ingredient whereDeletedAt($value)
 * @method static Builder<static>|Ingredient whereId($value)
 * @method static Builder<static>|Ingredient whereMenuId($value)
 * @method static Builder<static>|Ingredient whereQuantity($value)
 * @method static Builder<static>|Ingredient whereStockItemId($value)
 * @method static Builder<static>|Ingredient whereUnitId($value)
 * @method static Builder<static>|Ingredient whereUpdatedAt($value)
 * @method static Builder<static>|Ingredient withTrashed()
 * @method static Builder<static>|Ingredient withoutTrashed()
 * @mixin \Eloquent
 */
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

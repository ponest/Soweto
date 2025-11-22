<?php

namespace Modules\Inventory\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;
use Modules\Setups\Models\ItemCategory;
use Modules\Setups\Models\Unit;

/**
 *
 *
 * @property int $id
 * @property string $name
 * @property int $category_id
 * @property int $bulk_unit_id
 * @property int $unit_id
 * @property int $reorder_level
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Carbon|null $deleted_at
 * @property-read Unit|null $baseUnit
 * @property-read ItemCategory $category
 * @property-read Unit $unit
 * @method static Builder<static>|StockItem newModelQuery()
 * @method static Builder<static>|StockItem newQuery()
 * @method static Builder<static>|StockItem onlyTrashed()
 * @method static Builder<static>|StockItem query()
 * @method static Builder<static>|StockItem whereBulkUnitId($value)
 * @method static Builder<static>|StockItem whereCategoryId($value)
 * @method static Builder<static>|StockItem whereCreatedAt($value)
 * @method static Builder<static>|StockItem whereDeletedAt($value)
 * @method static Builder<static>|StockItem whereId($value)
 * @method static Builder<static>|StockItem whereName($value)
 * @method static Builder<static>|StockItem whereReorderLevel($value)
 * @method static Builder<static>|StockItem whereUnitId($value)
 * @method static Builder<static>|StockItem whereUpdatedAt($value)
 * @method static Builder<static>|StockItem withTrashed()
 * @method static Builder<static>|StockItem withoutTrashed()
 * @mixin \Eloquent
 */
class StockItem extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    public static function isExist($name)
    {
        return self:: where('name', $name)->first();
    }

    public static function isExistOnEdit($name, $id)
    {
        return self::where([['name', $name], ['id', '!=', $id]])->first();
    }

    public function unit(): BelongsTo
    {
        return $this->belongsTo(Unit::class, 'unit_id');
    }

    public function bulkUnit(): BelongsTo
    {
        return $this->belongsTo(Unit::class, 'bulk_unit_id');
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(ItemCategory::class);
    }

    public static function getAll(): Collection
    {
        return self::orderBy('name')->get();
    }

    public static function getStoreItemBalance($id)
    {
        $mainStoreId = Store::where('name','Main Store')->first()->id;
        $total = ItemStockIn::where('item_id', $id)->where('store_id',$mainStoreId)->sum('quantity');
        $total_issued = StockRequisitionItem::where('stock_item_id', $id)->sum('issued_quantity');
        return $total - $total_issued;
    }
}

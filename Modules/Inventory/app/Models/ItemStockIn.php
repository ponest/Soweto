<?php

namespace Modules\Inventory\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Setups\Models\Unit;

/**
 * 
 *
 * @property int $id
 * @property int $item_id
 * @property int|null $supplier_id
 * @property float $quantity
 * @property int $unit_id
 * @property float|null $bulk_quantity
 * @property int|null $bulk_unit_id
 * @property float|null $unit_price
 * @property float|null $total_price
 * @property string $received_date
 * @property int|null $department_id
 * @property int|null $store_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read Unit|null $bulkUnit
 * @property-read \Modules\Inventory\Models\StockItem $item
 * @property-read \Modules\Inventory\Models\Supplier|null $supplier
 * @property-read Unit $unit
 * @method static Builder<static>|ItemStockIn newModelQuery()
 * @method static Builder<static>|ItemStockIn newQuery()
 * @method static Builder<static>|ItemStockIn onlyTrashed()
 * @method static Builder<static>|ItemStockIn query()
 * @method static Builder<static>|ItemStockIn whereBulkQuantity($value)
 * @method static Builder<static>|ItemStockIn whereBulkUnitId($value)
 * @method static Builder<static>|ItemStockIn whereCreatedAt($value)
 * @method static Builder<static>|ItemStockIn whereDeletedAt($value)
 * @method static Builder<static>|ItemStockIn whereDepartmentId($value)
 * @method static Builder<static>|ItemStockIn whereId($value)
 * @method static Builder<static>|ItemStockIn whereItemId($value)
 * @method static Builder<static>|ItemStockIn whereQuantity($value)
 * @method static Builder<static>|ItemStockIn whereReceivedDate($value)
 * @method static Builder<static>|ItemStockIn whereStoreId($value)
 * @method static Builder<static>|ItemStockIn whereSupplierId($value)
 * @method static Builder<static>|ItemStockIn whereTotalPrice($value)
 * @method static Builder<static>|ItemStockIn whereUnitId($value)
 * @method static Builder<static>|ItemStockIn whereUnitPrice($value)
 * @method static Builder<static>|ItemStockIn whereUpdatedAt($value)
 * @method static Builder<static>|ItemStockIn withTrashed()
 * @method static Builder<static>|ItemStockIn withoutTrashed()
 * @mixin \Eloquent
 */
class ItemStockIn extends Model
{
    use SoftDeletes;

    protected $guarded = [];
    public $table = 'item_stock_in';

    public function bulkUnit(): BelongsTo
    {
        return $this->belongsTo(Unit::class, 'bulk_unit_id');
    }

    public function unit(): BelongsTo
    {
        return $this->belongsTo(Unit::class, 'unit_id');
    }

    public function supplier(): BelongsTo
    {
        return $this->belongsTo(Supplier::class);
    }

    public function item(): BelongsTo
    {
        return $this->belongsTo(StockItem::class);
    }
}

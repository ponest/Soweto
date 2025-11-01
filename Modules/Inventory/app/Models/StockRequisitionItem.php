<?php

namespace Modules\Inventory\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;
use Modules\Setups\Models\Unit;

/**
 *
 * @property int $id
 * @property int $stock_requisition_id
 * @property int $stock_item_id
 * @property int $unit_id
 * @property float $requested_quantity
 * @property float|null $issued_quantity
 * @property int $is_issued
 * @property int $is_received
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Carbon|null $deleted_at
 * @method static Builder<static>|StockRequisitionItem newModelQuery()
 * @method static Builder<static>|StockRequisitionItem newQuery()
 * @method static Builder<static>|StockRequisitionItem onlyTrashed()
 * @method static Builder<static>|StockRequisitionItem query()
 * @method static Builder<static>|StockRequisitionItem whereCreatedAt($value)
 * @method static Builder<static>|StockRequisitionItem whereDeletedAt($value)
 * @method static Builder<static>|StockRequisitionItem whereId($value)
 * @method static Builder<static>|StockRequisitionItem whereIsIssued($value)
 * @method static Builder<static>|StockRequisitionItem whereIsReceived($value)
 * @method static Builder<static>|StockRequisitionItem whereIssuedQuantity($value)
 * @method static Builder<static>|StockRequisitionItem whereRequestedQuantity($value)
 * @method static Builder<static>|StockRequisitionItem whereStockItemId($value)
 * @method static Builder<static>|StockRequisitionItem whereStockRequisitionId($value)
 * @method static Builder<static>|StockRequisitionItem whereUnitId($value)
 * @method static Builder<static>|StockRequisitionItem whereUpdatedAt($value)
 * @method static Builder<static>|StockRequisitionItem withTrashed()
 * @method static Builder<static>|StockRequisitionItem withoutTrashed()
 * @mixin \Eloquent
 */
class StockRequisitionItem extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    public static function isExist($itemId, $stockRequisitionId)
    {
        return self:: where([['stock_item_id', $itemId], ['stock_requisition_id', $stockRequisitionId]])->first();
    }

    public static function isExistOnEdit($itemId, $stockRequisitionId, $id)
    {
        return self::where([['stock_item_id', $itemId], ['stock_requisition_id', $stockRequisitionId], ['id', '!=', $id]])->first();
    }

    public function stockItem()
    {
        return $this->belongsTo(StockItem::class);
    }

    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }
}

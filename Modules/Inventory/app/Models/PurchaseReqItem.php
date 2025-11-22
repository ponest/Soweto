<?php

namespace Modules\Inventory\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;
use Modules\Setups\Models\Unit;

/**
 *
 *
 * @property int $id
 * @property int $purchase_request_id
 * @property int $stock_item_id
 * @property int $unit_id
 * @property string $quantity
 * @property string $unit_price
 * @property string $total_price
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Carbon|null $deleted_at
 * @method static Builder<static>|PurchaseReqItem newModelQuery()
 * @method static Builder<static>|PurchaseReqItem newQuery()
 * @method static Builder<static>|PurchaseReqItem onlyTrashed()
 * @method static Builder<static>|PurchaseReqItem query()
 * @method static Builder<static>|PurchaseReqItem whereCreatedAt($value)
 * @method static Builder<static>|PurchaseReqItem whereDeletedAt($value)
 * @method static Builder<static>|PurchaseReqItem whereId($value)
 * @method static Builder<static>|PurchaseReqItem wherePurchaseRequestId($value)
 * @method static Builder<static>|PurchaseReqItem whereQuantity($value)
 * @method static Builder<static>|PurchaseReqItem whereStockItemId($value)
 * @method static Builder<static>|PurchaseReqItem whereTotalPrice($value)
 * @method static Builder<static>|PurchaseReqItem whereUnitId($value)
 * @method static Builder<static>|PurchaseReqItem whereUnitPrice($value)
 * @method static Builder<static>|PurchaseReqItem whereUpdatedAt($value)
 * @method static Builder<static>|PurchaseReqItem withTrashed()
 * @method static Builder<static>|PurchaseReqItem withoutTrashed()
 * @mixin \Eloquent
 */
class PurchaseReqItem extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    public static function isExist($itemId, $purchaseReqId): PurchaseReqItem|null
    {
        return PurchaseReqItem::where([['stock_item_id', $itemId], ['purchase_request_id', $purchaseReqId]])->first();
    }

    public static function isExistOnEdit($itemId, $purchaseReqId, $id): PurchaseReqItem|null
    {
        return PurchaseReqItem::where([['stock_item_id', $itemId], ['purchase_request_id', $purchaseReqId], ['id', '!=', $id]])->first();
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

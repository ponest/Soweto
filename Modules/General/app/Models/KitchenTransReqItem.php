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
 * @property int $id
 * @property int $kitchen_trans_req_id
 * @property int $stock_item_id
 * @property float $quantity
 * @property int $unit_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Carbon|null $deleted_at
 * @property-read StockItem $stockItem
 * @property-read Unit $unit
 * @method static Builder<static>|KitchenTransReqItem newModelQuery()
 * @method static Builder<static>|KitchenTransReqItem newQuery()
 * @method static Builder<static>|KitchenTransReqItem onlyTrashed()
 * @method static Builder<static>|KitchenTransReqItem query()
 * @method static Builder<static>|KitchenTransReqItem whereCreatedAt($value)
 * @method static Builder<static>|KitchenTransReqItem whereDeletedAt($value)
 * @method static Builder<static>|KitchenTransReqItem whereId($value)
 * @method static Builder<static>|KitchenTransReqItem whereKitchenTransReqId($value)
 * @method static Builder<static>|KitchenTransReqItem whereQuantity($value)
 * @method static Builder<static>|KitchenTransReqItem whereStockItemId($value)
 * @method static Builder<static>|KitchenTransReqItem whereUnitId($value)
 * @method static Builder<static>|KitchenTransReqItem whereUpdatedAt($value)
 * @method static Builder<static>|KitchenTransReqItem withTrashed(bool $withTrashed = true)
 * @method static Builder<static>|KitchenTransReqItem withoutTrashed()
 * @mixin \Eloquent
 */
class KitchenTransReqItem extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    public static function isExist($itemId, $kitchenTransRequestId): KitchenTransReqItem|null
    {
        return KitchenTransReqItem:: where([['stock_item_id', $itemId], ['kitchen_trans_req_id', $kitchenTransRequestId]])->first();
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

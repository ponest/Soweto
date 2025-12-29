<?php

namespace Modules\General\Models;

use Eloquent;
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
 * @property int $backlog_request_id
 * @property int $stock_item_id
 * @property float $quantity
 * @property int $unit_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Carbon|null $deleted_at
 * @method static Builder<static>|StockBacklogItem newModelQuery()
 * @method static Builder<static>|StockBacklogItem newQuery()
 * @method static Builder<static>|StockBacklogItem onlyTrashed()
 * @method static Builder<static>|StockBacklogItem query()
 * @method static Builder<static>|StockBacklogItem whereBacklogRequestId($value)
 * @method static Builder<static>|StockBacklogItem whereCreatedAt($value)
 * @method static Builder<static>|StockBacklogItem whereDeletedAt($value)
 * @method static Builder<static>|StockBacklogItem whereId($value)
 * @method static Builder<static>|StockBacklogItem whereQuantity($value)
 * @method static Builder<static>|StockBacklogItem whereStockItemId($value)
 * @method static Builder<static>|StockBacklogItem whereUnitId($value)
 * @method static Builder<static>|StockBacklogItem whereUpdatedAt($value)
 * @method static Builder<static>|StockBacklogItem withTrashed()
 * @method static Builder<static>|StockBacklogItem withoutTrashed()
 * @mixin Eloquent
 */
class StockBacklogItem extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    public static function isExist($itemId, $backlogRequestId): StockBacklogItem|null
    {
        return StockBacklogItem:: where([['stock_item_id', $itemId], ['backlog_request_id', $backlogRequestId]])->first();
    }

    public static function isExistOnEdit($itemId, $backlogRequestId, $id)
    {
        return StockBacklogItem::where([['stock_item_id', $itemId], ['backlog_request_id', $backlogRequestId], ['id', '!=', $id]])->first();
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

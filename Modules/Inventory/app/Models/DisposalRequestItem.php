<?php

namespace Modules\Inventory\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;
use Modules\Setups\Models\Unit;

/**
 * @property int $id
 * @property int $disposal_request_id
 * @property int $stock_item_id
 * @property int $unit_id
 * @property int $store_id
 * @property numeric $quantity
 * @property string|null $remarks
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Carbon|null $deleted_at
 * @method static Builder<static>|DisposalRequestItem newModelQuery()
 * @method static Builder<static>|DisposalRequestItem newQuery()
 * @method static Builder<static>|DisposalRequestItem onlyTrashed()
 * @method static Builder<static>|DisposalRequestItem query()
 * @method static Builder<static>|DisposalRequestItem whereCreatedAt($value)
 * @method static Builder<static>|DisposalRequestItem whereDeletedAt($value)
 * @method static Builder<static>|DisposalRequestItem whereDisposalRequestId($value)
 * @method static Builder<static>|DisposalRequestItem whereId($value)
 * @method static Builder<static>|DisposalRequestItem whereQuantity($value)
 * @method static Builder<static>|DisposalRequestItem whereRemarks($value)
 * @method static Builder<static>|DisposalRequestItem whereStockItemId($value)
 * @method static Builder<static>|DisposalRequestItem whereStoreId($value)
 * @method static Builder<static>|DisposalRequestItem whereUnitId($value)
 * @method static Builder<static>|DisposalRequestItem whereUpdatedAt($value)
 * @method static Builder<static>|DisposalRequestItem withTrashed(bool $withTrashed = true)
 * @method static Builder<static>|DisposalRequestItem withoutTrashed()
 * @mixin \Eloquent
 */
class DisposalRequestItem extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    public static function isExist($itemId, $disposalRequestId): DisposalRequestItem|null
    {
        return DisposalRequestItem::where([['stock_item_id', $itemId], ['disposal_request_id', $disposalRequestId]])->first();
    }

    public static function isExistOnEdit($itemId, $disposalRequestId, $id): DisposalRequestItem|null
    {
        return DisposalRequestItem::where([['stock_item_id', $itemId], ['disposal_request_id', $disposalRequestId], ['id', '!=', $id]])->first();
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

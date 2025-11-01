<?php

namespace Modules\Sales\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;
use Modules\Inventory\Models\StockItem;

// use Modules\Sales\Database\Factories\PriceApprovalItemFactory;

/**
 *
 *
 * @property int $id
 * @property int $price_approval_id
 * @property int $item_id
 * @property string $price
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Carbon|null $deleted_at
 * @method static Builder<static>|PriceApprovalItem newModelQuery()
 * @method static Builder<static>|PriceApprovalItem newQuery()
 * @method static Builder<static>|PriceApprovalItem onlyTrashed()
 * @method static Builder<static>|PriceApprovalItem query()
 * @method static Builder<static>|PriceApprovalItem whereCreatedAt($value)
 * @method static Builder<static>|PriceApprovalItem whereDeletedAt($value)
 * @method static Builder<static>|PriceApprovalItem whereId($value)
 * @method static Builder<static>|PriceApprovalItem whereItemId($value)
 * @method static Builder<static>|PriceApprovalItem wherePrice($value)
 * @method static Builder<static>|PriceApprovalItem wherePriceApprovalId($value)
 * @method static Builder<static>|PriceApprovalItem whereUpdatedAt($value)
 * @method static Builder<static>|PriceApprovalItem withTrashed()
 * @method static Builder<static>|PriceApprovalItem withoutTrashed()
 * @mixin Eloquent
 */
class PriceApprovalItem extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     */
    protected $guarded = [];

    public static function isExist($itemId, $priceApprovalId)
    {
        return self:: where([['item_id', $itemId], ['price_approval_id', $priceApprovalId]])->first();
    }

    public static function isExistOnEdit($itemId, $priceApprovalId, $id)
    {
        return self::where([['item_id', $itemId], ['price_approval_id', $priceApprovalId], ['id', '!=', $id]])->first();
    }

    public function stockItem(): BelongsTo
    {
        return $this->belongsTo(StockItem::class, 'item_id');
    }
}

<?php

namespace Modules\Sales\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;
use Modules\Inventory\Models\StockItem;

// use Modules\Sales\Database\Factories\ItemPriceFactory;

/**
 *
 *
 * @property int $id
 * @property int $item_id
 * @property string $price
 * @property int $is_active
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Carbon|null $deleted_at
 * @method static Builder<static>|ItemPrice newModelQuery()
 * @method static Builder<static>|ItemPrice newQuery()
 * @method static Builder<static>|ItemPrice onlyTrashed()
 * @method static Builder<static>|ItemPrice query()
 * @method static Builder<static>|ItemPrice whereCreatedAt($value)
 * @method static Builder<static>|ItemPrice whereDeletedAt($value)
 * @method static Builder<static>|ItemPrice whereId($value)
 * @method static Builder<static>|ItemPrice whereIsActive($value)
 * @method static Builder<static>|ItemPrice whereItemId($value)
 * @method static Builder<static>|ItemPrice wherePrice($value)
 * @method static Builder<static>|ItemPrice whereUpdatedAt($value)
 * @method static Builder<static>|ItemPrice withTrashed()
 * @method static Builder<static>|ItemPrice withoutTrashed()
 * @mixin \Eloquent
 */
class ItemPrice extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    public function stockItem(): BelongsTo
    {
        return $this->belongsTo(StockItem::class,'item_id');
    }

}

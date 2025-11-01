<?php

namespace Modules\Inventory\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

// use Modules\Inventory\Database\Factories\StoreItemFactory;

/**
 *
 *
 * @property int $id
 * @property int $store_id
 * @property int $item_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Carbon|null $deleted_at
 * @method static Builder<static>|StoreItem newModelQuery()
 * @method static Builder<static>|StoreItem newQuery()
 * @method static Builder<static>|StoreItem onlyTrashed()
 * @method static Builder<static>|StoreItem query()
 * @method static Builder<static>|StoreItem whereCreatedAt($value)
 * @method static Builder<static>|StoreItem whereDeletedAt($value)
 * @method static Builder<static>|StoreItem whereId($value)
 * @method static Builder<static>|StoreItem whereItemId($value)
 * @method static Builder<static>|StoreItem whereStoreId($value)
 * @method static Builder<static>|StoreItem whereUpdatedAt($value)
 * @method static Builder<static>|StoreItem withTrashed()
 * @method static Builder<static>|StoreItem withoutTrashed()
 * @mixin Eloquent
 */
class StoreItem extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    public function stockItem(): BelongsTo
    {
        return $this->belongsTo(StockItem::class, 'item_id');
    }

    public static function stockBalance($storeId,$itemId): array
    {
        $totalReceived = ItemStockIn::where([['store_id',$storeId],['item_id',$itemId]])->sum('quantity');
        $totalIssued = ItemStockOut::where([['store_id',$storeId],['item_id',$itemId]])->sum('quantity');
//        return $totalReceived - $totalIssued;
        return [
            'total_received' => $totalReceived,
            'total_issued' => $totalIssued,
            'balance' => $totalReceived - $totalIssued
        ];
    }
}

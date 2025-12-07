<?php

namespace Modules\HotelMgnt\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;
use Modules\Inventory\Models\StockItem;


/**
 * 
 *
 * @property int $id
 * @property int $room_id
 * @property int $stock_item_id
 * @property int $quantity
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Carbon|null $deleted_at
 * @method static Builder<static>|RoomItem newModelQuery()
 * @method static Builder<static>|RoomItem newQuery()
 * @method static Builder<static>|RoomItem onlyTrashed()
 * @method static Builder<static>|RoomItem query()
 * @method static Builder<static>|RoomItem whereCreatedAt($value)
 * @method static Builder<static>|RoomItem whereDeletedAt($value)
 * @method static Builder<static>|RoomItem whereId($value)
 * @method static Builder<static>|RoomItem whereQuantity($value)
 * @method static Builder<static>|RoomItem whereRoomId($value)
 * @method static Builder<static>|RoomItem whereStockItemId($value)
 * @method static Builder<static>|RoomItem whereUpdatedAt($value)
 * @method static Builder<static>|RoomItem withTrashed()
 * @method static Builder<static>|RoomItem withoutTrashed()
 * @mixin Eloquent
 */
class RoomItem extends Model
{
    use SoftDeletes;

    protected $guarded  = [];

    public static function isExist($stock_item_id,$room_id): RoomItem|null
    {
        return RoomItem:: where([['stock_item_id',$stock_item_id],['room_id',$room_id]])->first();
    }

    public static function isExistOnEdit($stock_item_id,$room_id, $id): RoomItem|null
    {
        return RoomItem::where([['stock_item_id',$stock_item_id],['room_id',$room_id], ['id', '!=', $id]])->first();
    }


    public function stockItem(): BelongsTo
    {
        return $this->belongsTo(StockItem::class);
    }
}

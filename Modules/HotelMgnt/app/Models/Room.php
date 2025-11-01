<?php

namespace Modules\HotelMgnt\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

// use Modules\HotelMgnt\Database\Factories\RoomFactory;

/**
 *
 *
 * @property int $id
 * @property int $room_type_id
 * @property string $room_number
 * @property string $status
 * @property int|null $rate_per_night
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Modules\HotelMgnt\Models\RoomType $roomType
 * @method static Builder<static>|Room newModelQuery()
 * @method static Builder<static>|Room newQuery()
 * @method static Builder<static>|Room onlyTrashed()
 * @method static Builder<static>|Room query()
 * @method static Builder<static>|Room whereCreatedAt($value)
 * @method static Builder<static>|Room whereDeletedAt($value)
 * @method static Builder<static>|Room whereId($value)
 * @method static Builder<static>|Room whereRatePerNight($value)
 * @method static Builder<static>|Room whereRoomNumber($value)
 * @method static Builder<static>|Room whereRoomTypeId($value)
 * @method static Builder<static>|Room whereStatus($value)
 * @method static Builder<static>|Room whereUpdatedAt($value)
 * @method static Builder<static>|Room withTrashed()
 * @method static Builder<static>|Room withoutTrashed()
 * @mixin \Eloquent
 */
class Room extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    public static function isExist($name)
    {
        return self:: where('room_number', $name)->first();
    }

    public static function isExistOnEdit($name, $id)
    {
        return self::where([['room_number', $name], ['id', '!=', $id]])->first();
    }

    public function roomType(): BelongsTo
    {
        return $this->belongsTo(RoomType::class);
    }

    public static function getAvailableRooms(): Collection
    {
        return Room::where('status', '=', 'Available')->orderBy('room_number')->get();
    }
}

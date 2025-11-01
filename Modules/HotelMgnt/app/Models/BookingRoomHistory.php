<?php

namespace Modules\HotelMgnt\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

/**
 * 
 *
 * @property int $id
 * @property int $booking_id
 * @property int $room_id
 * @property string $start_date
 * @property string|null $end_date
 * @property string $rate
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Carbon|null $deleted_at
 * @property int $is_billed
 * @property-read Booking $booking
 * @property-read Room $room
 * @method static Builder<static>|BookingRoomHistory newModelQuery()
 * @method static Builder<static>|BookingRoomHistory newQuery()
 * @method static Builder<static>|BookingRoomHistory onlyTrashed()
 * @method static Builder<static>|BookingRoomHistory query()
 * @method static Builder<static>|BookingRoomHistory whereBookingId($value)
 * @method static Builder<static>|BookingRoomHistory whereCreatedAt($value)
 * @method static Builder<static>|BookingRoomHistory whereDeletedAt($value)
 * @method static Builder<static>|BookingRoomHistory whereEndDate($value)
 * @method static Builder<static>|BookingRoomHistory whereId($value)
 * @method static Builder<static>|BookingRoomHistory whereIsBilled($value)
 * @method static Builder<static>|BookingRoomHistory whereRate($value)
 * @method static Builder<static>|BookingRoomHistory whereRoomId($value)
 * @method static Builder<static>|BookingRoomHistory whereStartDate($value)
 * @method static Builder<static>|BookingRoomHistory whereUpdatedAt($value)
 * @method static Builder<static>|BookingRoomHistory withTrashed()
 * @method static Builder<static>|BookingRoomHistory withoutTrashed()
 * @mixin \Eloquent
 */
class BookingRoomHistory extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    public function booking(): BelongsTo
    {
        return $this->belongsTo(Booking::class);
    }

    public function room(): BelongsTo
    {
        return $this->belongsTo(Room::class);
    }
}

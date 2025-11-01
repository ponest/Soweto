<?php

namespace Modules\HotelMgnt\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;
use Modules\Auth\Models\User;

/**
 * 
 *
 * @property int $id
 * @property int $booking_id
 * @property string $checked_in_at
 * @property string|null $checked_out_at
 * @property string|null $remarks
 * @property int $checked_in_by
 * @property int|null $checked_out_by
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Carbon|null $deleted_at
 * @property int|null $room_id
 * @property int $is_billed
 * @property int|null $billed_by
 * @property string|null $billed_at
 * @property int $is_paid
 * @property string $paid_amount
 * @property string|null $payment_method
 * @property string|null $payment_reference
 * @property-read \Modules\HotelMgnt\Models\Booking $booking
 * @property-read User $checkedInBy
 * @property-read User|null $checkedOutBy
 * @property-read \Modules\HotelMgnt\Models\Room|null $room
 * @method static Builder<static>|RoomCheckInOut newModelQuery()
 * @method static Builder<static>|RoomCheckInOut newQuery()
 * @method static Builder<static>|RoomCheckInOut onlyTrashed()
 * @method static Builder<static>|RoomCheckInOut query()
 * @method static Builder<static>|RoomCheckInOut whereBilledAt($value)
 * @method static Builder<static>|RoomCheckInOut whereBilledBy($value)
 * @method static Builder<static>|RoomCheckInOut whereBookingId($value)
 * @method static Builder<static>|RoomCheckInOut whereCheckedInAt($value)
 * @method static Builder<static>|RoomCheckInOut whereCheckedInBy($value)
 * @method static Builder<static>|RoomCheckInOut whereCheckedOutAt($value)
 * @method static Builder<static>|RoomCheckInOut whereCheckedOutBy($value)
 * @method static Builder<static>|RoomCheckInOut whereCreatedAt($value)
 * @method static Builder<static>|RoomCheckInOut whereDeletedAt($value)
 * @method static Builder<static>|RoomCheckInOut whereId($value)
 * @method static Builder<static>|RoomCheckInOut whereIsBilled($value)
 * @method static Builder<static>|RoomCheckInOut whereIsPaid($value)
 * @method static Builder<static>|RoomCheckInOut wherePaidAmount($value)
 * @method static Builder<static>|RoomCheckInOut wherePaymentMethod($value)
 * @method static Builder<static>|RoomCheckInOut wherePaymentReference($value)
 * @method static Builder<static>|RoomCheckInOut whereRemarks($value)
 * @method static Builder<static>|RoomCheckInOut whereRoomId($value)
 * @method static Builder<static>|RoomCheckInOut whereUpdatedAt($value)
 * @method static Builder<static>|RoomCheckInOut withTrashed()
 * @method static Builder<static>|RoomCheckInOut withoutTrashed()
 * @mixin \Eloquent
 */
class RoomCheckInOut extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     */
    protected $guarded = [];

    public function checkedInBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'checked_in_by');
    }

    public function checkedOutBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'checked_out_by');
    }

    public function booking(): BelongsTo
    {
        return $this->belongsTo(Booking::class);
    }

    public function room(): BelongsTo
    {
        return $this->belongsTo(Room::class);
    }
}

<?php

namespace Modules\HotelMgnt\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

/**
 * 
 *
 * @property int $id
 * @property int $guest_id
 * @property int $room_id
 * @property string|null $proposed_start_date
 * @property string|null $proposed_end_date
 * @property string $booking_status
 * @property int $created_by
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Carbon|null $deleted_at
 * @property int|null $cancelled_by
 * @property string|null $cancelled_at
 * @property string|null $cancellation_remarks
 * @property-read \Modules\HotelMgnt\Models\Guest $guest
 * @property-read \Modules\HotelMgnt\Models\Room $room
 * @method static Builder<static>|Booking newModelQuery()
 * @method static Builder<static>|Booking newQuery()
 * @method static Builder<static>|Booking onlyTrashed()
 * @method static Builder<static>|Booking query()
 * @method static Builder<static>|Booking whereBookingStatus($value)
 * @method static Builder<static>|Booking whereCancellationRemarks($value)
 * @method static Builder<static>|Booking whereCancelledAt($value)
 * @method static Builder<static>|Booking whereCancelledBy($value)
 * @method static Builder<static>|Booking whereCreatedAt($value)
 * @method static Builder<static>|Booking whereCreatedBy($value)
 * @method static Builder<static>|Booking whereDeletedAt($value)
 * @method static Builder<static>|Booking whereGuestId($value)
 * @method static Builder<static>|Booking whereId($value)
 * @method static Builder<static>|Booking whereProposedEndDate($value)
 * @method static Builder<static>|Booking whereProposedStartDate($value)
 * @method static Builder<static>|Booking whereRoomId($value)
 * @method static Builder<static>|Booking whereUpdatedAt($value)
 * @method static Builder<static>|Booking withTrashed()
 * @method static Builder<static>|Booking withoutTrashed()
 * @mixin \Eloquent
 */
class Booking extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    public function guest(): BelongsTo
    {
        return $this->belongsTo(Guest::class);
    }

    public function room(): BelongsTo
    {
        return $this->belongsTo(Room::class);
    }

    public function roomHistories(): HasMany
    {
        return $this->hasMany(BookingRoomHistory::class);
    }

}

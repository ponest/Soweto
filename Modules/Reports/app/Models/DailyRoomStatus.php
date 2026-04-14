<?php

namespace Modules\Reports\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property int $room_id
 * @property string $room_type
 * @property int $rate
 * @property int $guest
 * @property string $arrival_date
 * @property string $departure_date
 * @property int $no_of_nights
 * @property int $pax
 * @property string $date
 * @property numeric $day
 * @property string $month
 * @property string $year
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @method static Builder<static>|DailyRoomStatus newModelQuery()
 * @method static Builder<static>|DailyRoomStatus newQuery()
 * @method static Builder<static>|DailyRoomStatus onlyTrashed()
 * @method static Builder<static>|DailyRoomStatus query()
 * @method static Builder<static>|DailyRoomStatus whereArrivalDate($value)
 * @method static Builder<static>|DailyRoomStatus whereCreatedAt($value)
 * @method static Builder<static>|DailyRoomStatus whereDate($value)
 * @method static Builder<static>|DailyRoomStatus whereDay($value)
 * @method static Builder<static>|DailyRoomStatus whereDeletedAt($value)
 * @method static Builder<static>|DailyRoomStatus whereDepartureDate($value)
 * @method static Builder<static>|DailyRoomStatus whereGuest($value)
 * @method static Builder<static>|DailyRoomStatus whereMonth($value)
 * @method static Builder<static>|DailyRoomStatus whereNoOfNights($value)
 * @method static Builder<static>|DailyRoomStatus wherePax($value)
 * @method static Builder<static>|DailyRoomStatus whereRate($value)
 * @method static Builder<static>|DailyRoomStatus whereRoomId($value)
 * @method static Builder<static>|DailyRoomStatus whereRoomType($value)
 * @method static Builder<static>|DailyRoomStatus whereUpdatedAt($value)
 * @method static Builder<static>|DailyRoomStatus whereYear($value)
 * @method static Builder<static>|DailyRoomStatus withTrashed(bool $withTrashed = true)
 * @method static Builder<static>|DailyRoomStatus withoutTrashed()
 * @property string $room_number
 * @method static Builder<static>|DailyRoomStatus whereRoomNumber($value)
 * @mixin \Eloquent
 */
class DailyRoomStatus extends Model
{
    use SoftDeletes;

    protected $table = 'daily_room_status';

    protected $guarded = [];
}

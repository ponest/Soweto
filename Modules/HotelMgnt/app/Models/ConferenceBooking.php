<?php

namespace Modules\HotelMgnt\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;


/**
 * 
 *
 * @property int $id
 * @property int $client_id
 * @property int $conference_room_id
 * @property string $start_date
 * @property string $end_date
 * @property string $booking_status
 * @property int $number_of_people
 * @property int $amount_paid
 * @property float $discount_percentage
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Carbon|null $deleted_at
 * @method static Builder<static>|ConferenceBooking newModelQuery()
 * @method static Builder<static>|ConferenceBooking newQuery()
 * @method static Builder<static>|ConferenceBooking onlyTrashed()
 * @method static Builder<static>|ConferenceBooking query()
 * @method static Builder<static>|ConferenceBooking whereAmountPaid($value)
 * @method static Builder<static>|ConferenceBooking whereBookingStatus($value)
 * @method static Builder<static>|ConferenceBooking whereClientId($value)
 * @method static Builder<static>|ConferenceBooking whereConferenceRoomId($value)
 * @method static Builder<static>|ConferenceBooking whereCreatedAt($value)
 * @method static Builder<static>|ConferenceBooking whereDeletedAt($value)
 * @method static Builder<static>|ConferenceBooking whereDiscountPercentage($value)
 * @method static Builder<static>|ConferenceBooking whereEndDate($value)
 * @method static Builder<static>|ConferenceBooking whereId($value)
 * @method static Builder<static>|ConferenceBooking whereNumberOfPeople($value)
 * @method static Builder<static>|ConferenceBooking whereStartDate($value)
 * @method static Builder<static>|ConferenceBooking whereUpdatedAt($value)
 * @method static Builder<static>|ConferenceBooking withTrashed()
 * @method static Builder<static>|ConferenceBooking withoutTrashed()
 * @mixin \Eloquent
 */
class ConferenceBooking extends Model
{
    use SoftDeletes;

    protected $guarded  = [];
}

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
 * @property int $booking_id
 * @property string $type
 * @property string|null $description
 * @property string $amount
 * @property string $expense_date
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Carbon|null $deleted_at
 * @property int $can_modify
 * @property int $is_billed
 * @method static Builder<static>|BookingCharges newModelQuery()
 * @method static Builder<static>|BookingCharges newQuery()
 * @method static Builder<static>|BookingCharges onlyTrashed()
 * @method static Builder<static>|BookingCharges query()
 * @method static Builder<static>|BookingCharges whereAmount($value)
 * @method static Builder<static>|BookingCharges whereBookingId($value)
 * @method static Builder<static>|BookingCharges whereCanModify($value)
 * @method static Builder<static>|BookingCharges whereCreatedAt($value)
 * @method static Builder<static>|BookingCharges whereDeletedAt($value)
 * @method static Builder<static>|BookingCharges whereDescription($value)
 * @method static Builder<static>|BookingCharges whereExpenseDate($value)
 * @method static Builder<static>|BookingCharges whereId($value)
 * @method static Builder<static>|BookingCharges whereIsBilled($value)
 * @method static Builder<static>|BookingCharges whereType($value)
 * @method static Builder<static>|BookingCharges whereUpdatedAt($value)
 * @method static Builder<static>|BookingCharges withTrashed()
 * @method static Builder<static>|BookingCharges withoutTrashed()
 * @mixin \Eloquent
 */
class BookingCharges extends Model
{
    use SoftDeletes;

    protected $guarded  = [];

}

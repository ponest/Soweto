<?php

namespace Modules\HotelMgnt\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

/**
 * 
 *
 * @property int $id
 * @property int $advance_payment_id
 * @property int|null $booking_id
 * @property string $amount
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Carbon|null $deleted_at
 * @method static Builder<static>|AdvancePaymentTransaction newModelQuery()
 * @method static Builder<static>|AdvancePaymentTransaction newQuery()
 * @method static Builder<static>|AdvancePaymentTransaction onlyTrashed()
 * @method static Builder<static>|AdvancePaymentTransaction query()
 * @method static Builder<static>|AdvancePaymentTransaction whereAdvancePaymentId($value)
 * @method static Builder<static>|AdvancePaymentTransaction whereAmount($value)
 * @method static Builder<static>|AdvancePaymentTransaction whereBookingId($value)
 * @method static Builder<static>|AdvancePaymentTransaction whereCreatedAt($value)
 * @method static Builder<static>|AdvancePaymentTransaction whereDeletedAt($value)
 * @method static Builder<static>|AdvancePaymentTransaction whereId($value)
 * @method static Builder<static>|AdvancePaymentTransaction whereUpdatedAt($value)
 * @method static Builder<static>|AdvancePaymentTransaction withTrashed()
 * @method static Builder<static>|AdvancePaymentTransaction withoutTrashed()
 * @mixin Eloquent
 */
class AdvancePaymentTransaction extends Model
{
    use SoftDeletes;

    protected $guarded = [];
}

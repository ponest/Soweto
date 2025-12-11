<?php

namespace Modules\HotelMgnt\Models;

use Eloquent;
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
 * @property string $request_number
 * @property int|null $booking_id
 * @property string $description
 * @property string $status
 * @property int|null $submitted_by
 * @property string|null $submitted_at
 * @property int|null $reviewed_by
 * @property string|null $reviewed_at
 * @property int|null $approved_by
 * @property string|null $approved_at
 * @property int|null $is_approved
 * @property string|null $reject_comments
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Carbon|null $deleted_at
 * @method static Builder<static>|CheckOutRequest newModelQuery()
 * @method static Builder<static>|CheckOutRequest newQuery()
 * @method static Builder<static>|CheckOutRequest onlyTrashed()
 * @method static Builder<static>|CheckOutRequest query()
 * @method static Builder<static>|CheckOutRequest whereApprovedAt($value)
 * @method static Builder<static>|CheckOutRequest whereApprovedBy($value)
 * @method static Builder<static>|CheckOutRequest whereBookingId($value)
 * @method static Builder<static>|CheckOutRequest whereCreatedAt($value)
 * @method static Builder<static>|CheckOutRequest whereDeletedAt($value)
 * @method static Builder<static>|CheckOutRequest whereDescription($value)
 * @method static Builder<static>|CheckOutRequest whereId($value)
 * @method static Builder<static>|CheckOutRequest whereIsApproved($value)
 * @method static Builder<static>|CheckOutRequest whereRejectComments($value)
 * @method static Builder<static>|CheckOutRequest whereRequestNumber($value)
 * @method static Builder<static>|CheckOutRequest whereReviewedAt($value)
 * @method static Builder<static>|CheckOutRequest whereReviewedBy($value)
 * @method static Builder<static>|CheckOutRequest whereStatus($value)
 * @method static Builder<static>|CheckOutRequest whereSubmittedAt($value)
 * @method static Builder<static>|CheckOutRequest whereSubmittedBy($value)
 * @method static Builder<static>|CheckOutRequest whereUpdatedAt($value)
 * @method static Builder<static>|CheckOutRequest withTrashed()
 * @method static Builder<static>|CheckOutRequest withoutTrashed()
 * @mixin Eloquent
 */
class CheckOutRequest extends Model
{
    use SoftDeletes;

    protected $guarded = [];
    protected $table = 'check_out_request';

    public static function isExist($booking_id): CheckOutRequest|null
    {
        return CheckOutRequest:: where('booking_id', $booking_id)->first();
    }

    public function booking(): BelongsTo
    {
        return $this->belongsTo(Booking::class);
    }

    public function submittedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'submitted_by');
    }

    public function approvedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'approved_by');
    }

    public function reviewedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'reviewed_by');
    }

    public static function totalCharges($bookingId)
    {
        return BookingCharges::whereBookingId($bookingId)->sum('total_price');
    }


}

<?php

namespace Modules\Sales\Models;

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
 * @property string|null $reference_no
 * @property int|null $ref_id
 * @property string|null $category
 * @property int|null $booking_id
 * @property string $bill_amount
 * @property string $paid_amount
 * @property string $remaining_balance
 * @property string $status
 * @property string $issued_at
 * @property int $issued_by
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Carbon|null $deleted_at
 * @property string|null $payment_method
 * @property string|null $payment_reference
 * @property string|null $discount_amount
 * @property string|null $discount_reference
 * @property string|null $payment_confirmed_at
 * @property int|null $payment_confirmed_by
 * @property int|null $department_id
 * @method static Builder<static>|Bill newModelQuery()
 * @method static Builder<static>|Bill newQuery()
 * @method static Builder<static>|Bill onlyTrashed()
 * @method static Builder<static>|Bill query()
 * @method static Builder<static>|Bill whereBillAmount($value)
 * @method static Builder<static>|Bill whereBookingId($value)
 * @method static Builder<static>|Bill whereCategory($value)
 * @method static Builder<static>|Bill whereCreatedAt($value)
 * @method static Builder<static>|Bill whereDeletedAt($value)
 * @method static Builder<static>|Bill whereDepartmentId($value)
 * @method static Builder<static>|Bill whereDiscountAmount($value)
 * @method static Builder<static>|Bill whereDiscountReference($value)
 * @method static Builder<static>|Bill whereId($value)
 * @method static Builder<static>|Bill whereIssuedAt($value)
 * @method static Builder<static>|Bill whereIssuedBy($value)
 * @method static Builder<static>|Bill wherePaidAmount($value)
 * @method static Builder<static>|Bill wherePaymentConfirmedAt($value)
 * @method static Builder<static>|Bill wherePaymentConfirmedBy($value)
 * @method static Builder<static>|Bill wherePaymentMethod($value)
 * @method static Builder<static>|Bill wherePaymentReference($value)
 * @method static Builder<static>|Bill whereRefId($value)
 * @method static Builder<static>|Bill whereReferenceNo($value)
 * @method static Builder<static>|Bill whereRemainingBalance($value)
 * @method static Builder<static>|Bill whereStatus($value)
 * @method static Builder<static>|Bill whereUpdatedAt($value)
 * @method static Builder<static>|Bill withTrashed()
 * @method static Builder<static>|Bill withoutTrashed()
 * @mixin \Eloquent
 */
class Bill extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    public function issuer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'issued_by');
    }
}

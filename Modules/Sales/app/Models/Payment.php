<?php

namespace Modules\Sales\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;
use Modules\Auth\Models\User;
use Modules\Setups\Models\PaymentMethod;

/**
 *
 *
 * @property int $id
 * @property int $bill_id
 * @property int $payment_method_id
 * @property string $paid_amount
 * @property string $payment_reference
 * @property int $payment_confirmed_by
 * @property string $payment_confirmed_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Carbon|null $deleted_at
 * @method static Builder<static>|Payment newModelQuery()
 * @method static Builder<static>|Payment newQuery()
 * @method static Builder<static>|Payment onlyTrashed()
 * @method static Builder<static>|Payment query()
 * @method static Builder<static>|Payment whereBillId($value)
 * @method static Builder<static>|Payment whereCreatedAt($value)
 * @method static Builder<static>|Payment whereDeletedAt($value)
 * @method static Builder<static>|Payment whereId($value)
 * @method static Builder<static>|Payment wherePaidAmount($value)
 * @method static Builder<static>|Payment wherePaymentConfirmedAt($value)
 * @method static Builder<static>|Payment wherePaymentConfirmedBy($value)
 * @method static Builder<static>|Payment wherePaymentMethodId($value)
 * @method static Builder<static>|Payment wherePaymentReference($value)
 * @method static Builder<static>|Payment whereUpdatedAt($value)
 * @method static Builder<static>|Payment withTrashed()
 * @method static Builder<static>|Payment withoutTrashed()
 * @mixin \Eloquent
 */
class Payment extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    public function confirmedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'payment_confirmed_by');
    }

    public function paymentMethod(): BelongsTo
    {
        return $this->belongsTo(PaymentMethod::class);
    }
}

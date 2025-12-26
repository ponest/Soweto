<?php

namespace Modules\HotelMgnt\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Auth\Models\User;
use Modules\Setups\Models\PaymentMethod;

/**
 * 
 *
 * @property int $id
 * @property int $client_id
 * @property int $booking_id
 * @property string $reference_number
 * @property int $payment_method_id
 * @property string|null $transaction_reference_number
 * @property string $amount
 * @property int $created_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property int $is_used
 * @property-read \Modules\HotelMgnt\Models\Booking $booking
 * @property-read \Modules\HotelMgnt\Models\Client $client
 * @property-read User $creator
 * @property-read PaymentMethod $paymentMethod
 * @method static Builder<static>|AdvancePayment newModelQuery()
 * @method static Builder<static>|AdvancePayment newQuery()
 * @method static Builder<static>|AdvancePayment onlyTrashed()
 * @method static Builder<static>|AdvancePayment query()
 * @method static Builder<static>|AdvancePayment whereAmount($value)
 * @method static Builder<static>|AdvancePayment whereBookingId($value)
 * @method static Builder<static>|AdvancePayment whereClientId($value)
 * @method static Builder<static>|AdvancePayment whereCreatedAt($value)
 * @method static Builder<static>|AdvancePayment whereCreatedBy($value)
 * @method static Builder<static>|AdvancePayment whereDeletedAt($value)
 * @method static Builder<static>|AdvancePayment whereId($value)
 * @method static Builder<static>|AdvancePayment whereIsUsed($value)
 * @method static Builder<static>|AdvancePayment wherePaymentMethodId($value)
 * @method static Builder<static>|AdvancePayment whereReferenceNumber($value)
 * @method static Builder<static>|AdvancePayment whereTransactionReferenceNumber($value)
 * @method static Builder<static>|AdvancePayment whereUpdatedAt($value)
 * @method static Builder<static>|AdvancePayment withTrashed()
 * @method static Builder<static>|AdvancePayment withoutTrashed()
 * @mixin \Eloquent
 */
class AdvancePayment extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    public function booking(): BelongsTo
    {
        return $this->belongsTo(Booking::class);
    }

    public function paymentMethod(): BelongsTo
    {
        return $this->belongsTo(PaymentMethod::class);
    }

    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class,'created_by');
    }
}

<?php

namespace Modules\HotelMgnt\Models;

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
 * @property int $client_id
 * @property string $reference_no
 * @property string $transaction_reference_no
 * @property string $wallet_amount
 * @property int|null $created_by
 * @property int|null $approved_by
 * @property string|null $approved_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Carbon|null $deleted_at
 * @property int $is_active
 * @property int|null $submitted_by
 * @property string|null $submitted_at
 * @property int|null $reviewed_by
 * @property string|null $reviewed_at
 * @property int|null $is_approved
 * @property string|null $reject_comments
 * @property string|null $status
 * @property int|null $payment_method_id
 * @property-read \Modules\HotelMgnt\Models\Client $client
 * @property-read User|null $reviewer
 * @method static Builder<static>|ClientWallet newModelQuery()
 * @method static Builder<static>|ClientWallet newQuery()
 * @method static Builder<static>|ClientWallet onlyTrashed()
 * @method static Builder<static>|ClientWallet query()
 * @method static Builder<static>|ClientWallet whereApprovedAt($value)
 * @method static Builder<static>|ClientWallet whereApprovedBy($value)
 * @method static Builder<static>|ClientWallet whereClientId($value)
 * @method static Builder<static>|ClientWallet whereCreatedAt($value)
 * @method static Builder<static>|ClientWallet whereCreatedBy($value)
 * @method static Builder<static>|ClientWallet whereDeletedAt($value)
 * @method static Builder<static>|ClientWallet whereId($value)
 * @method static Builder<static>|ClientWallet whereIsActive($value)
 * @method static Builder<static>|ClientWallet whereIsApproved($value)
 * @method static Builder<static>|ClientWallet wherePaymentMethodId($value)
 * @method static Builder<static>|ClientWallet whereReferenceNo($value)
 * @method static Builder<static>|ClientWallet whereRejectComments($value)
 * @method static Builder<static>|ClientWallet whereReviewedAt($value)
 * @method static Builder<static>|ClientWallet whereReviewedBy($value)
 * @method static Builder<static>|ClientWallet whereStatus($value)
 * @method static Builder<static>|ClientWallet whereSubmittedAt($value)
 * @method static Builder<static>|ClientWallet whereSubmittedBy($value)
 * @method static Builder<static>|ClientWallet whereTransactionReferenceNo($value)
 * @method static Builder<static>|ClientWallet whereUpdatedAt($value)
 * @method static Builder<static>|ClientWallet whereWalletAmount($value)
 * @method static Builder<static>|ClientWallet withTrashed()
 * @method static Builder<static>|ClientWallet withoutTrashed()
 * @mixin \Eloquent
 */
class ClientWallet extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }

    public function reviewer(): BelongsTo
    {
        return $this->belongsTo(User::class,'reviewed_by');
    }

    public function paymentMethod(): BelongsTo
    {
        return $this->belongsTo(PaymentMethod::class);
    }
}

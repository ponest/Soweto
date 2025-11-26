<?php

namespace Modules\General\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;
use Modules\Auth\Models\User;
use Modules\HotelMgnt\Models\Client;


/**
 *
 *
 * @property int $id
 * @property string $request_number
 * @property int|null $client_id
 * @property string $description
 * @property string $status
 * @property string|null $discount_code
 * @property int|null $submitted_by
 * @property string|null $submitted_at
 * @property int|null $reviewed_by
 * @property string|null $reviewed_at
 * @property int|null $approved_by
 * @property string|null $approved_at
 * @property int|null $is_approved
 * @property string|null $reject_comments
 * @property int $is_used
 * @property string|null $used_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Carbon|null $deleted_at
 * @property-read Client|null $client
 * @method static Builder<static>|DiscountReq newModelQuery()
 * @method static Builder<static>|DiscountReq newQuery()
 * @method static Builder<static>|DiscountReq onlyTrashed()
 * @method static Builder<static>|DiscountReq query()
 * @method static Builder<static>|DiscountReq whereApprovedAt($value)
 * @method static Builder<static>|DiscountReq whereApprovedBy($value)
 * @method static Builder<static>|DiscountReq whereClientId($value)
 * @method static Builder<static>|DiscountReq whereCreatedAt($value)
 * @method static Builder<static>|DiscountReq whereDeletedAt($value)
 * @method static Builder<static>|DiscountReq whereDescription($value)
 * @method static Builder<static>|DiscountReq whereDiscountCode($value)
 * @method static Builder<static>|DiscountReq whereId($value)
 * @method static Builder<static>|DiscountReq whereIsApproved($value)
 * @method static Builder<static>|DiscountReq whereIsUsed($value)
 * @method static Builder<static>|DiscountReq whereRejectComments($value)
 * @method static Builder<static>|DiscountReq whereRequestNumber($value)
 * @method static Builder<static>|DiscountReq whereReviewedAt($value)
 * @method static Builder<static>|DiscountReq whereReviewedBy($value)
 * @method static Builder<static>|DiscountReq whereStatus($value)
 * @method static Builder<static>|DiscountReq whereSubmittedAt($value)
 * @method static Builder<static>|DiscountReq whereSubmittedBy($value)
 * @method static Builder<static>|DiscountReq whereUpdatedAt($value)
 * @method static Builder<static>|DiscountReq whereUsedAt($value)
 * @method static Builder<static>|DiscountReq withTrashed()
 * @method static Builder<static>|DiscountReq withoutTrashed()
 * @mixin \Eloquent
 */
class DiscountReq extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }

    public function submittedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'submitted_by');
    }

    public function approvedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'approved_by');
    }

}

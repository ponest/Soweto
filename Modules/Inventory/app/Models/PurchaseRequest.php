<?php

namespace Modules\Inventory\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Auth\Models\User;


/**
 * 
 *
 * @property int $id
 * @property string $description
 * @property string $request_number
 * @property string $status
 * @property int|null $is_approved
 * @property int|null $submitted_by
 * @property string|null $submitted_at
 * @property int|null $reviewed_by
 * @property string|null $reviewed_at
 * @property int|null $approved_by
 * @property string|null $approved_at
 * @property string|null $reject_comments
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @method static Builder<static>|PurchaseRequest newModelQuery()
 * @method static Builder<static>|PurchaseRequest newQuery()
 * @method static Builder<static>|PurchaseRequest onlyTrashed()
 * @method static Builder<static>|PurchaseRequest query()
 * @method static Builder<static>|PurchaseRequest whereApprovedAt($value)
 * @method static Builder<static>|PurchaseRequest whereApprovedBy($value)
 * @method static Builder<static>|PurchaseRequest whereCreatedAt($value)
 * @method static Builder<static>|PurchaseRequest whereDeletedAt($value)
 * @method static Builder<static>|PurchaseRequest whereDescription($value)
 * @method static Builder<static>|PurchaseRequest whereId($value)
 * @method static Builder<static>|PurchaseRequest whereIsApproved($value)
 * @method static Builder<static>|PurchaseRequest whereRejectComments($value)
 * @method static Builder<static>|PurchaseRequest whereRequestNumber($value)
 * @method static Builder<static>|PurchaseRequest whereReviewedAt($value)
 * @method static Builder<static>|PurchaseRequest whereReviewedBy($value)
 * @method static Builder<static>|PurchaseRequest whereStatus($value)
 * @method static Builder<static>|PurchaseRequest whereSubmittedAt($value)
 * @method static Builder<static>|PurchaseRequest whereSubmittedBy($value)
 * @method static Builder<static>|PurchaseRequest whereUpdatedAt($value)
 * @method static Builder<static>|PurchaseRequest withTrashed()
 * @method static Builder<static>|PurchaseRequest withoutTrashed()
 * @mixin \Eloquent
 */
class PurchaseRequest extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    public function submittedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'submitted_by');
    }

    public function reviewedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'reviewed_by');
    }
}

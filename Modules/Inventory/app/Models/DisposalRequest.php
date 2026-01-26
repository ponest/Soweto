<?php

namespace Modules\Inventory\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Auth\Models\User;

// use Modules\Inventory\Database\Factories\DisposalReqFactory;

/**
 * @property int $id
 * @property string $description
 * @property string $request_number
 * @property string $status
 * @property int $store_id
 * @property int|null $submitted_by
 * @property string|null $submitted_at
 * @property int|null $reviewed_by
 * @property string|null $reviewed_at
 * @property int|null $approved_by
 * @property string|null $approved_at
 * @property int|null $is_approved
 * @property string|null $reject_comments
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @method static Builder<static>|DisposalRequest newModelQuery()
 * @method static Builder<static>|DisposalRequest newQuery()
 * @method static Builder<static>|DisposalRequest onlyTrashed()
 * @method static Builder<static>|DisposalRequest query()
 * @method static Builder<static>|DisposalRequest whereApprovedAt($value)
 * @method static Builder<static>|DisposalRequest whereApprovedBy($value)
 * @method static Builder<static>|DisposalRequest whereCreatedAt($value)
 * @method static Builder<static>|DisposalRequest whereDeletedAt($value)
 * @method static Builder<static>|DisposalRequest whereDescription($value)
 * @method static Builder<static>|DisposalRequest whereId($value)
 * @method static Builder<static>|DisposalRequest whereIsApproved($value)
 * @method static Builder<static>|DisposalRequest whereRejectComments($value)
 * @method static Builder<static>|DisposalRequest whereRequestNumber($value)
 * @method static Builder<static>|DisposalRequest whereReviewedAt($value)
 * @method static Builder<static>|DisposalRequest whereReviewedBy($value)
 * @method static Builder<static>|DisposalRequest whereStatus($value)
 * @method static Builder<static>|DisposalRequest whereStoreId($value)
 * @method static Builder<static>|DisposalRequest whereSubmittedAt($value)
 * @method static Builder<static>|DisposalRequest whereSubmittedBy($value)
 * @method static Builder<static>|DisposalRequest whereUpdatedAt($value)
 * @method static Builder<static>|DisposalRequest withTrashed(bool $withTrashed = true)
 * @method static Builder<static>|DisposalRequest withoutTrashed()
 * @mixin \Eloquent
 */
class DisposalRequest extends Model
{
    use SoftDeletes;

    protected $guarded = [];

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

    public function disposalItems(): HasMany
    {
        return $this->hasMany(DisposalRequestItem::class);
    }

    public function store(): BelongsTo
    {
        return $this->belongsTo(Store::class);
    }

}

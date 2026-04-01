<?php

namespace Modules\General\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;
use Modules\Auth\Models\User;

/**
 * @property int $id
 * @property string $request_number
 * @property string $report_date
 * @property string $description
 * @property string $status
 * @property int|null $submitted_by
 * @property string|null $submitted_at
 * @property int|null $reviewed_by
 * @property string|null $reviewed_at
 * @property int|null $is_approved
 * @property string|null $reject_comments
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Carbon|null $deleted_at
 * @method static Builder<static>|KitchenTransReq newModelQuery()
 * @method static Builder<static>|KitchenTransReq newQuery()
 * @method static Builder<static>|KitchenTransReq onlyTrashed()
 * @method static Builder<static>|KitchenTransReq query()
 * @method static Builder<static>|KitchenTransReq whereCreatedAt($value)
 * @method static Builder<static>|KitchenTransReq whereDeletedAt($value)
 * @method static Builder<static>|KitchenTransReq whereDescription($value)
 * @method static Builder<static>|KitchenTransReq whereId($value)
 * @method static Builder<static>|KitchenTransReq whereIsApproved($value)
 * @method static Builder<static>|KitchenTransReq whereRejectComments($value)
 * @method static Builder<static>|KitchenTransReq whereReportDate($value)
 * @method static Builder<static>|KitchenTransReq whereRequestNumber($value)
 * @method static Builder<static>|KitchenTransReq whereReviewedAt($value)
 * @method static Builder<static>|KitchenTransReq whereReviewedBy($value)
 * @method static Builder<static>|KitchenTransReq whereStatus($value)
 * @method static Builder<static>|KitchenTransReq whereSubmittedAt($value)
 * @method static Builder<static>|KitchenTransReq whereSubmittedBy($value)
 * @method static Builder<static>|KitchenTransReq whereUpdatedAt($value)
 * @method static Builder<static>|KitchenTransReq withTrashed(bool $withTrashed = true)
 * @method static Builder<static>|KitchenTransReq withoutTrashed()
 * @mixin \Eloquent
 */
class KitchenTransReq extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    public function submittedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'submitted_by');
    }

    public function approvedBy(): BelongsTo
    {
        return $this->belongsTo(User::class,'reviewed_by');
    }

    public function reviewedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'reviewed_by');
    }
}

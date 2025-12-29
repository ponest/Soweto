<?php

namespace Modules\General\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;
use Modules\Auth\Models\User;
use Modules\Inventory\Models\Store;


/**
 *
 *
 * @property int $id
 * @property string $description
 * @property string $request_number
 * @property string $status
 * @property int $store_id
 * @property string|null $submitted_at
 * @property int|null $submitted_by
 * @property string|null $reviewed_at
 * @property int|null $reviewed_by
 * @property int|null $is_approved
 * @property string|null $reject_comments
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Carbon|null $deleted_at
 * @method static Builder<static>|StockBacklogRequest newModelQuery()
 * @method static Builder<static>|StockBacklogRequest newQuery()
 * @method static Builder<static>|StockBacklogRequest onlyTrashed()
 * @method static Builder<static>|StockBacklogRequest query()
 * @method static Builder<static>|StockBacklogRequest whereCreatedAt($value)
 * @method static Builder<static>|StockBacklogRequest whereDeletedAt($value)
 * @method static Builder<static>|StockBacklogRequest whereDescription($value)
 * @method static Builder<static>|StockBacklogRequest whereId($value)
 * @method static Builder<static>|StockBacklogRequest whereIsApproved($value)
 * @method static Builder<static>|StockBacklogRequest whereRejectComments($value)
 * @method static Builder<static>|StockBacklogRequest whereRequestNumber($value)
 * @method static Builder<static>|StockBacklogRequest whereReviewedAt($value)
 * @method static Builder<static>|StockBacklogRequest whereReviewedBy($value)
 * @method static Builder<static>|StockBacklogRequest whereStatus($value)
 * @method static Builder<static>|StockBacklogRequest whereStoreId($value)
 * @method static Builder<static>|StockBacklogRequest whereSubmittedAt($value)
 * @method static Builder<static>|StockBacklogRequest whereSubmittedBy($value)
 * @method static Builder<static>|StockBacklogRequest whereUpdatedAt($value)
 * @method static Builder<static>|StockBacklogRequest withTrashed()
 * @method static Builder<static>|StockBacklogRequest withoutTrashed()
 * @mixin Eloquent
 */
class StockBacklogRequest extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    public function submittedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'submitted_by');
    }

    public function store(): BelongsTo
    {
        return $this->belongsTo(Store::class);
    }

    public function approvedBy(): BelongsTo
    {
        return $this->belongsTo(User::class,'reviewed_by');
    }

    public function reviewedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'reviewed_by');
    }

    public function items(): HasMany
    {
        return $this->hasMany(StockBacklogItem::class,'backlog_request_id');
    }
}

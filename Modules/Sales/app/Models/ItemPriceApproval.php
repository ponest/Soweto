<?php

namespace Modules\Sales\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;
use Modules\Auth\Models\User;


/**
 *
 *
 * @property int $id
 * @property string $description
 * @property string $request_number
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
 * @method static Builder<static>|ItemPriceApproval newModelQuery()
 * @method static Builder<static>|ItemPriceApproval newQuery()
 * @method static Builder<static>|ItemPriceApproval onlyTrashed()
 * @method static Builder<static>|ItemPriceApproval query()
 * @method static Builder<static>|ItemPriceApproval whereCreatedAt($value)
 * @method static Builder<static>|ItemPriceApproval whereDeletedAt($value)
 * @method static Builder<static>|ItemPriceApproval whereDescription($value)
 * @method static Builder<static>|ItemPriceApproval whereId($value)
 * @method static Builder<static>|ItemPriceApproval whereIsApproved($value)
 * @method static Builder<static>|ItemPriceApproval whereRejectComments($value)
 * @method static Builder<static>|ItemPriceApproval whereRequestNumber($value)
 * @method static Builder<static>|ItemPriceApproval whereReviewedAt($value)
 * @method static Builder<static>|ItemPriceApproval whereReviewedBy($value)
 * @method static Builder<static>|ItemPriceApproval whereStatus($value)
 * @method static Builder<static>|ItemPriceApproval whereSubmittedAt($value)
 * @method static Builder<static>|ItemPriceApproval whereSubmittedBy($value)
 * @method static Builder<static>|ItemPriceApproval whereUpdatedAt($value)
 * @method static Builder<static>|ItemPriceApproval withTrashed()
 * @method static Builder<static>|ItemPriceApproval withoutTrashed()
 * @mixin Eloquent
 */
class ItemPriceApproval extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    public static function isExist($description)
    {
        return self:: where('description', $description)->first();
    }

    public static function isExistOnEdit($description, $id)
    {
        return self::where([['description', $description], ['id', '!=', $id]])->first();
    }

    public function approvalItems(): HasMany
    {
        return $this->hasMany(PriceApprovalItem::class, 'price_approval_id');
    }

    public function submittedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'submitted_by');
    }
}

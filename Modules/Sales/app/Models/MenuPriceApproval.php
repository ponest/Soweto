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
 * @property-read User|null $submittedBy
 * @method static Builder<static>|MenuPriceApproval newModelQuery()
 * @method static Builder<static>|MenuPriceApproval newQuery()
 * @method static Builder<static>|MenuPriceApproval onlyTrashed()
 * @method static Builder<static>|MenuPriceApproval query()
 * @method static Builder<static>|MenuPriceApproval whereCreatedAt($value)
 * @method static Builder<static>|MenuPriceApproval whereDeletedAt($value)
 * @method static Builder<static>|MenuPriceApproval whereDescription($value)
 * @method static Builder<static>|MenuPriceApproval whereId($value)
 * @method static Builder<static>|MenuPriceApproval whereIsApproved($value)
 * @method static Builder<static>|MenuPriceApproval whereRejectComments($value)
 * @method static Builder<static>|MenuPriceApproval whereRequestNumber($value)
 * @method static Builder<static>|MenuPriceApproval whereReviewedAt($value)
 * @method static Builder<static>|MenuPriceApproval whereReviewedBy($value)
 * @method static Builder<static>|MenuPriceApproval whereStatus($value)
 * @method static Builder<static>|MenuPriceApproval whereSubmittedAt($value)
 * @method static Builder<static>|MenuPriceApproval whereSubmittedBy($value)
 * @method static Builder<static>|MenuPriceApproval whereUpdatedAt($value)
 * @method static Builder<static>|MenuPriceApproval withTrashed()
 * @method static Builder<static>|MenuPriceApproval withoutTrashed()
 * @mixin Eloquent
 */
class MenuPriceApproval extends Model
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

    public function menuPriceItems(): HasMany
    {
        return $this->hasMany(MenuPriceApprovalItem::class, 'menu_price_approval_id');
    }

    public function submittedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'submitted_by');
    }

}

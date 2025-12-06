<?php

namespace Modules\General\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

/**
 * 
 *
 * @property int $id
 * @property int $discount_id
 * @property string $amount
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Carbon|null $deleted_at
 * @method static Builder<static>|DiscountTransaction newModelQuery()
 * @method static Builder<static>|DiscountTransaction newQuery()
 * @method static Builder<static>|DiscountTransaction onlyTrashed()
 * @method static Builder<static>|DiscountTransaction query()
 * @method static Builder<static>|DiscountTransaction whereAmount($value)
 * @method static Builder<static>|DiscountTransaction whereCreatedAt($value)
 * @method static Builder<static>|DiscountTransaction whereDeletedAt($value)
 * @method static Builder<static>|DiscountTransaction whereDiscountId($value)
 * @method static Builder<static>|DiscountTransaction whereId($value)
 * @method static Builder<static>|DiscountTransaction whereUpdatedAt($value)
 * @method static Builder<static>|DiscountTransaction withTrashed()
 * @method static Builder<static>|DiscountTransaction withoutTrashed()
 * @mixin Eloquent
 */
class DiscountTransaction extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     */
    protected $guarded = [];


}

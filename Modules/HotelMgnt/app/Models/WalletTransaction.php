<?php

namespace Modules\HotelMgnt\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;


/**
 * 
 *
 * @property int $id
 * @property int $wallet_id
 * @property string $amount
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Carbon|null $deleted_at
 * @method static Builder<static>|WalletTransaction newModelQuery()
 * @method static Builder<static>|WalletTransaction newQuery()
 * @method static Builder<static>|WalletTransaction onlyTrashed()
 * @method static Builder<static>|WalletTransaction query()
 * @method static Builder<static>|WalletTransaction whereAmount($value)
 * @method static Builder<static>|WalletTransaction whereCreatedAt($value)
 * @method static Builder<static>|WalletTransaction whereDeletedAt($value)
 * @method static Builder<static>|WalletTransaction whereId($value)
 * @method static Builder<static>|WalletTransaction whereUpdatedAt($value)
 * @method static Builder<static>|WalletTransaction whereWalletId($value)
 * @method static Builder<static>|WalletTransaction withTrashed()
 * @method static Builder<static>|WalletTransaction withoutTrashed()
 * @mixin Eloquent
 */
class WalletTransaction extends Model
{
    use SoftDeletes;

    protected $guarded = [];

}

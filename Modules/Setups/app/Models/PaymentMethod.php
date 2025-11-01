<?php

namespace Modules\Setups\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

/**
 *
 *
 * @property int $id
 * @property string $name
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Carbon|null $deleted_at
 * @method static Builder<static>|PaymentMethod newModelQuery()
 * @method static Builder<static>|PaymentMethod newQuery()
 * @method static Builder<static>|PaymentMethod onlyTrashed()
 * @method static Builder<static>|PaymentMethod query()
 * @method static Builder<static>|PaymentMethod whereCreatedAt($value)
 * @method static Builder<static>|PaymentMethod whereDeletedAt($value)
 * @method static Builder<static>|PaymentMethod whereId($value)
 * @method static Builder<static>|PaymentMethod whereName($value)
 * @method static Builder<static>|PaymentMethod whereUpdatedAt($value)
 * @method static Builder<static>|PaymentMethod withTrashed()
 * @method static Builder<static>|PaymentMethod withoutTrashed()
 * @mixin Eloquent
 */
class PaymentMethod extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    public static function isExist($name): PaymentMethod|null
    {
        return PaymentMethod::where('name', $name)->first();
    }

    public static function isExistOnEdit($name, $id): PaymentMethod|null
    {
        return PaymentMethod::where([['name', $name], ['id', '!=', $id]])->first();
    }
}

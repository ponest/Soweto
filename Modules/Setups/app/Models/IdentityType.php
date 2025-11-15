<?php

namespace Modules\Setups\Models;

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
 * @method static Builder<static>|IdentityType newModelQuery()
 * @method static Builder<static>|IdentityType newQuery()
 * @method static Builder<static>|IdentityType onlyTrashed()
 * @method static Builder<static>|IdentityType query()
 * @method static Builder<static>|IdentityType whereCreatedAt($value)
 * @method static Builder<static>|IdentityType whereDeletedAt($value)
 * @method static Builder<static>|IdentityType whereId($value)
 * @method static Builder<static>|IdentityType whereName($value)
 * @method static Builder<static>|IdentityType whereUpdatedAt($value)
 * @method static Builder<static>|IdentityType withTrashed()
 * @method static Builder<static>|IdentityType withoutTrashed()
 * @mixin \Eloquent
 */
class IdentityType extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    public static function isExist($name): IdentityType|null
    {
        return IdentityType:: where('name', $name)->first();
    }

    public static function isExistOnEdit($name, $id): IdentityType|null
    {
        return IdentityType::where([['name', $name], ['id', '!=', $id]])->first();
    }
}

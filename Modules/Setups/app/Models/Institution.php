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
 * @method static Builder<static>|Institution newModelQuery()
 * @method static Builder<static>|Institution newQuery()
 * @method static Builder<static>|Institution onlyTrashed()
 * @method static Builder<static>|Institution query()
 * @method static Builder<static>|Institution whereCreatedAt($value)
 * @method static Builder<static>|Institution whereDeletedAt($value)
 * @method static Builder<static>|Institution whereId($value)
 * @method static Builder<static>|Institution whereName($value)
 * @method static Builder<static>|Institution whereUpdatedAt($value)
 * @method static Builder<static>|Institution withTrashed()
 * @method static Builder<static>|Institution withoutTrashed()
 * @mixin \Eloquent
 */
class Institution extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    public static function isExist($name)
    {
        return self:: where('name', $name)->first();
    }

    public static function isExistOnEdit($name, $id)
    {
        return self::where([['name', $name], ['id', '!=', $id]])->first();
    }
}

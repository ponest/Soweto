<?php

namespace Modules\Inventory\Models;

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
 * @method static Builder<static>|Store newModelQuery()
 * @method static Builder<static>|Store newQuery()
 * @method static Builder<static>|Store onlyTrashed()
 * @method static Builder<static>|Store query()
 * @method static Builder<static>|Store whereCreatedAt($value)
 * @method static Builder<static>|Store whereDeletedAt($value)
 * @method static Builder<static>|Store whereId($value)
 * @method static Builder<static>|Store whereName($value)
 * @method static Builder<static>|Store whereUpdatedAt($value)
 * @method static Builder<static>|Store withTrashed()
 * @method static Builder<static>|Store withoutTrashed()
 * @mixin \Eloquent
 */
class Store extends Model
{
    use SoftDeletes;

    protected $guarded  = [];

    public static function isExist($name)
    {
        return self:: where('name', $name)->first();
    }

    public static function isExistOnEdit($name, $id)
    {
        return self::where([['name', $name], ['id', '!=', $id]])->first();
    }

}

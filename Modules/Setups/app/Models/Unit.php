<?php

namespace Modules\Setups\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

// use Modules\Setups\Database\Factories\UnitFactory;

/**
 * @property int $id
 * @property string $name
 * @property string $symbol
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Carbon|null $deleted_at
 * @method static Builder<static>|Unit newModelQuery()
 * @method static Builder<static>|Unit newQuery()
 * @method static Builder<static>|Unit onlyTrashed()
 * @method static Builder<static>|Unit query()
 * @method static Builder<static>|Unit whereCreatedAt($value)
 * @method static Builder<static>|Unit whereDeletedAt($value)
 * @method static Builder<static>|Unit whereId($value)
 * @method static Builder<static>|Unit whereName($value)
 * @method static Builder<static>|Unit whereSymbol($value)
 * @method static Builder<static>|Unit whereUpdatedAt($value)
 * @method static Builder<static>|Unit withTrashed(bool $withTrashed = true)
 * @method static Builder<static>|Unit withoutTrashed()
 * @mixin \Eloquent
 */
class Unit extends Model
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

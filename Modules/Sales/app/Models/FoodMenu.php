<?php

namespace Modules\Sales\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

// use Modules\Sales\Database\Factories\FoodMenuFactory;

/**
 * 
 *
 * @property int $id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @method static Builder<static>|FoodMenu newModelQuery()
 * @method static Builder<static>|FoodMenu newQuery()
 * @method static Builder<static>|FoodMenu onlyTrashed()
 * @method static Builder<static>|FoodMenu query()
 * @method static Builder<static>|FoodMenu whereCreatedAt($value)
 * @method static Builder<static>|FoodMenu whereDeletedAt($value)
 * @method static Builder<static>|FoodMenu whereId($value)
 * @method static Builder<static>|FoodMenu whereName($value)
 * @method static Builder<static>|FoodMenu whereUpdatedAt($value)
 * @method static Builder<static>|FoodMenu withTrashed()
 * @method static Builder<static>|FoodMenu withoutTrashed()
 * @mixin \Eloquent
 */
class FoodMenu extends Model
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

    public static function getAll()
    {
        return self::orderBy('name')->get();
    }
}

<?php

namespace Modules\HotelMgnt\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

/**
 * 
 * @property int $id
 * @property string $name
 * @property int $capacity
 * @property int $rate_per_person
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Carbon|null $deleted_at
 * @method static Builder<static>|ConferenceRoom newModelQuery()
 * @method static Builder<static>|ConferenceRoom newQuery()
 * @method static Builder<static>|ConferenceRoom onlyTrashed()
 * @method static Builder<static>|ConferenceRoom query()
 * @method static Builder<static>|ConferenceRoom whereCapacity($value)
 * @method static Builder<static>|ConferenceRoom whereCreatedAt($value)
 * @method static Builder<static>|ConferenceRoom whereDeletedAt($value)
 * @method static Builder<static>|ConferenceRoom whereId($value)
 * @method static Builder<static>|ConferenceRoom whereName($value)
 * @method static Builder<static>|ConferenceRoom whereRatePerPerson($value)
 * @method static Builder<static>|ConferenceRoom whereUpdatedAt($value)
 * @method static Builder<static>|ConferenceRoom withTrashed()
 * @method static Builder<static>|ConferenceRoom withoutTrashed()
 * @mixin \Eloquent
 */
class ConferenceRoom extends Model
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

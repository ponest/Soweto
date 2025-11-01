<?php

namespace Modules\HotelMgnt\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;


/**
 *
 * @property int $id
 * @property int $institution_id
 * @property string $name
 * @property string|null $email
 * @property string $phone_number
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Carbon|null $deleted_at
 * @method static Builder<static>|Client newModelQuery()
 * @method static Builder<static>|Client newQuery()
 * @method static Builder<static>|Client onlyTrashed()
 * @method static Builder<static>|Client query()
 * @method static Builder<static>|Client whereCreatedAt($value)
 * @method static Builder<static>|Client whereDeletedAt($value)
 * @method static Builder<static>|Client whereEmail($value)
 * @method static Builder<static>|Client whereId($value)
 * @method static Builder<static>|Client whereInstitutionId($value)
 * @method static Builder<static>|Client whereName($value)
 * @method static Builder<static>|Client wherePhoneNumber($value)
 * @method static Builder<static>|Client whereUpdatedAt($value)
 * @method static Builder<static>|Client withTrashed()
 * @method static Builder<static>|Client withoutTrashed()
 * @mixin \Eloquent
 */
class Client extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    public static function isExist($name, $phone_number)
    {
        return self:: where([['phone_number', $phone_number], ['name', $name]])->first();
    }

    public static function isExistOnEdit($name, $phone_number, $id)
    {
        return self::where([['name', $name], ['phone_number', $phone_number], ['id', '!=', $id]])->first();
    }
}

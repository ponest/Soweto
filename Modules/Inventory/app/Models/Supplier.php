<?php

namespace Modules\Inventory\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property int $id
 * @property string $name
 * @property string $phone_number
 * @property string $email
 * @property string $postal_address
 * @property string $location
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @method static Builder<static>|Supplier newModelQuery()
 * @method static Builder<static>|Supplier newQuery()
 * @method static Builder<static>|Supplier onlyTrashed()
 * @method static Builder<static>|Supplier query()
 * @method static Builder<static>|Supplier whereCreatedAt($value)
 * @method static Builder<static>|Supplier whereDeletedAt($value)
 * @method static Builder<static>|Supplier whereEmail($value)
 * @method static Builder<static>|Supplier whereId($value)
 * @method static Builder<static>|Supplier whereLocation($value)
 * @method static Builder<static>|Supplier whereName($value)
 * @method static Builder<static>|Supplier wherePhoneNumber($value)
 * @method static Builder<static>|Supplier wherePostalAddress($value)
 * @method static Builder<static>|Supplier whereUpdatedAt($value)
 * @method static Builder<static>|Supplier withTrashed()
 * @method static Builder<static>|Supplier withoutTrashed()
 * @mixin \Eloquent
 */
class Supplier extends Model
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

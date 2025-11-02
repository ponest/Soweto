<?php

namespace Modules\HotelMgnt\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;
use Modules\Setups\Models\IdentityType;

/**
 * 
 *
 * @property int $id
 * @property string $full_name
 * @property string $gender
 * @property string|null $phone_number
 * @property string|null $email
 * @property int|null $identity_type_id
 * @property string|null $identity_number
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Carbon|null $deleted_at
 * @property-read IdentityType|null $identityType
 * @method static Builder<static>|Client newModelQuery()
 * @method static Builder<static>|Client newQuery()
 * @method static Builder<static>|Client onlyTrashed()
 * @method static Builder<static>|Client query()
 * @method static Builder<static>|Client whereCreatedAt($value)
 * @method static Builder<static>|Client whereDeletedAt($value)
 * @method static Builder<static>|Client whereEmail($value)
 * @method static Builder<static>|Client whereFullName($value)
 * @method static Builder<static>|Client whereGender($value)
 * @method static Builder<static>|Client whereId($value)
 * @method static Builder<static>|Client whereIdentityNumber($value)
 * @method static Builder<static>|Client whereIdentityTypeId($value)
 * @method static Builder<static>|Client wherePhoneNumber($value)
 * @method static Builder<static>|Client whereUpdatedAt($value)
 * @method static Builder<static>|Client withTrashed()
 * @method static Builder<static>|Client withoutTrashed()
 * @mixin \Eloquent
 */
class Client extends Model
{
    use SoftDeletes;

//    protected $table = 'hotel_guests';
    protected $guarded = [];

    public static function isExist($full_name, $phone_number)
    {
        return self:: where([['phone_number', $phone_number], ['full_name', $full_name]])->first();
    }

    public static function isExistOnEdit($full_name, $phone_number, $id)
    {
        return self::where([['full_name', $full_name], ['phone_number', $phone_number], ['id', '!=', $id]])->first();
    }

    public function identityType(): BelongsTo
    {
        return $this->belongsTo(IdentityType::class);
    }
}

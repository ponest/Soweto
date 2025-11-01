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
 * @method static Builder<static>|Guest newModelQuery()
 * @method static Builder<static>|Guest newQuery()
 * @method static Builder<static>|Guest onlyTrashed()
 * @method static Builder<static>|Guest query()
 * @method static Builder<static>|Guest whereCreatedAt($value)
 * @method static Builder<static>|Guest whereDeletedAt($value)
 * @method static Builder<static>|Guest whereEmail($value)
 * @method static Builder<static>|Guest whereFullName($value)
 * @method static Builder<static>|Guest whereGender($value)
 * @method static Builder<static>|Guest whereId($value)
 * @method static Builder<static>|Guest whereIdentityNumber($value)
 * @method static Builder<static>|Guest whereIdentityTypeId($value)
 * @method static Builder<static>|Guest wherePhoneNumber($value)
 * @method static Builder<static>|Guest whereUpdatedAt($value)
 * @method static Builder<static>|Guest withTrashed()
 * @method static Builder<static>|Guest withoutTrashed()
 * @mixin \Eloquent
 */
class Guest extends Model
{
    use SoftDeletes;

    protected $table = 'hotel_guests';
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

<?php

namespace Modules\General\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Setups\Models\StaffRole;


/**
 * 
 *
 * @property int $id
 * @property string $first_name
 * @property string $last_name
 * @property string $gender
 * @property string $physical_address
 * @property string $phone_number
 * @property int $staff_role_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @method static Builder<static>|Staff newModelQuery()
 * @method static Builder<static>|Staff newQuery()
 * @method static Builder<static>|Staff onlyTrashed()
 * @method static Builder<static>|Staff query()
 * @method static Builder<static>|Staff whereCreatedAt($value)
 * @method static Builder<static>|Staff whereDeletedAt($value)
 * @method static Builder<static>|Staff whereFirstName($value)
 * @method static Builder<static>|Staff whereGender($value)
 * @method static Builder<static>|Staff whereId($value)
 * @method static Builder<static>|Staff whereLastName($value)
 * @method static Builder<static>|Staff wherePhoneNumber($value)
 * @method static Builder<static>|Staff wherePhysicalAddress($value)
 * @method static Builder<static>|Staff whereStaffRoleId($value)
 * @method static Builder<static>|Staff whereUpdatedAt($value)
 * @method static Builder<static>|Staff withTrashed()
 * @method static Builder<static>|Staff withoutTrashed()
 * @mixin \Eloquent
 */
class Staff extends Model
{
    use SoftDeletes;

    protected $guarded = [];
    protected $table = 'staffs';

    public static function isExist($first_name, $last_name, $phone_number)
    {
        return self:: where([['first_name', $first_name], ['last_name', $last_name],
            ['phone_number', $phone_number]])->first();
    }

    public static function isExistOnEdit($first_name, $last_name, $phone_number, $id)
    {
        return self::where([['first_name', $first_name], ['last_name', $last_name],
            ['phone_number', $phone_number], ['id', '!=', $id]])->first();
    }

    public function staffRole()
    {
        return $this->belongsTo(StaffRole::class);
    }

    public function getFullNameAttribute(): string
    {
        return $this->first_name . ' ' . $this->last_name;
    }
}

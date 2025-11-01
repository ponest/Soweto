<?php

namespace Modules\Auth\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 *
 *
 * @property int $id
 * @property int $user_id
 * @property int $role_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder<static>|RoleUser newModelQuery()
 * @method static Builder<static>|RoleUser newQuery()
 * @method static Builder<static>|RoleUser query()
 * @method static Builder<static>|RoleUser whereCreatedAt($value)
 * @method static Builder<static>|RoleUser whereId($value)
 * @method static Builder<static>|RoleUser whereRoleId($value)
 * @method static Builder<static>|RoleUser whereUpdatedAt($value)
 * @method static Builder<static>|RoleUser whereUserId($value)
 * @mixin \Eloquent
 */
class RoleUser extends Model
{
    protected $guarded = [];
    protected $table = 'role_user';
}

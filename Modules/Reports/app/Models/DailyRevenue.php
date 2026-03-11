<?php

namespace Modules\Reports\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

/**
 * @property int $id
 * @property string $date
 * @property string $day
 * @property string $month
 * @property string $year
 * @property numeric $amount
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Carbon|null $deleted_at
 * @method static Builder<static>|DailyRevenue newModelQuery()
 * @method static Builder<static>|DailyRevenue newQuery()
 * @method static Builder<static>|DailyRevenue onlyTrashed()
 * @method static Builder<static>|DailyRevenue query()
 * @method static Builder<static>|DailyRevenue whereAmount($value)
 * @method static Builder<static>|DailyRevenue whereCreatedAt($value)
 * @method static Builder<static>|DailyRevenue whereDate($value)
 * @method static Builder<static>|DailyRevenue whereDay($value)
 * @method static Builder<static>|DailyRevenue whereDeletedAt($value)
 * @method static Builder<static>|DailyRevenue whereId($value)
 * @method static Builder<static>|DailyRevenue whereMonth($value)
 * @method static Builder<static>|DailyRevenue whereUpdatedAt($value)
 * @method static Builder<static>|DailyRevenue whereYear($value)
 * @method static Builder<static>|DailyRevenue withTrashed(bool $withTrashed = true)
 * @method static Builder<static>|DailyRevenue withoutTrashed()
 * @mixin \Eloquent
 */
class DailyRevenue extends Model
{
    use SoftDeletes;
    protected $guarded = [];
}

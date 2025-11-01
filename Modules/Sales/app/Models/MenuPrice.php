<?php

namespace Modules\Sales\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

// use Modules\Sales\Database\Factories\MenuPriceFactory;

/**
 * 
 *
 * @property int $id
 * @property int $menu_id
 * @property string $price
 * @property int $is_active
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Carbon|null $deleted_at
 * @method static Builder<static>|MenuPrice newModelQuery()
 * @method static Builder<static>|MenuPrice newQuery()
 * @method static Builder<static>|MenuPrice onlyTrashed()
 * @method static Builder<static>|MenuPrice query()
 * @method static Builder<static>|MenuPrice whereCreatedAt($value)
 * @method static Builder<static>|MenuPrice whereDeletedAt($value)
 * @method static Builder<static>|MenuPrice whereId($value)
 * @method static Builder<static>|MenuPrice whereIsActive($value)
 * @method static Builder<static>|MenuPrice whereMenuId($value)
 * @method static Builder<static>|MenuPrice wherePrice($value)
 * @method static Builder<static>|MenuPrice whereUpdatedAt($value)
 * @method static Builder<static>|MenuPrice withTrashed()
 * @method static Builder<static>|MenuPrice withoutTrashed()
 * @mixin Eloquent
 */
class MenuPrice extends Model
{
    use SoftDeletes;

    protected $guarded  = [];

    public function menuItem(): BelongsTo
    {
        return $this->belongsTo(FoodMenu::class,'menu_id');
    }
}

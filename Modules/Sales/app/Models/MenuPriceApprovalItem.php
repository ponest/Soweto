<?php

namespace Modules\Sales\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

// use Modules\Sales\Database\Factories\MenuPriceApprovalItemFactory;

/**
 *
 *
 * @property int $id
 * @property int $menu_price_approval_id
 * @property int $menu_id
 * @property string $price
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Carbon|null $deleted_at
 * @method static Builder<static>|MenuPriceApprovalItem newModelQuery()
 * @method static Builder<static>|MenuPriceApprovalItem newQuery()
 * @method static Builder<static>|MenuPriceApprovalItem onlyTrashed()
 * @method static Builder<static>|MenuPriceApprovalItem query()
 * @method static Builder<static>|MenuPriceApprovalItem whereCreatedAt($value)
 * @method static Builder<static>|MenuPriceApprovalItem whereDeletedAt($value)
 * @method static Builder<static>|MenuPriceApprovalItem whereId($value)
 * @method static Builder<static>|MenuPriceApprovalItem whereMenuId($value)
 * @method static Builder<static>|MenuPriceApprovalItem whereMenuPriceApprovalId($value)
 * @method static Builder<static>|MenuPriceApprovalItem wherePrice($value)
 * @method static Builder<static>|MenuPriceApprovalItem whereUpdatedAt($value)
 * @method static Builder<static>|MenuPriceApprovalItem withTrashed()
 * @method static Builder<static>|MenuPriceApprovalItem withoutTrashed()
 * @mixin Eloquent
 */
class MenuPriceApprovalItem extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     */
    protected $guarded = [];


    public static function isExist($menuId, $priceApprovalId)
    {
        return self:: where([['menu_id', $menuId], ['menu_price_approval_id', $priceApprovalId]])->first();
    }

    public static function isExistOnEdit($menuId, $priceApprovalId, $id)
    {
        return self::where([['menu_id', $menuId], ['menu_price_approval_id', $priceApprovalId], ['id', '!=', $id]])->first();
    }

    public function menuItem(): BelongsTo
    {
        return $this->belongsTo(FoodMenu::class, 'menu_id');
    }
}

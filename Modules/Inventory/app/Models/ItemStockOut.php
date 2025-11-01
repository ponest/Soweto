<?php

namespace Modules\Inventory\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

/**
 * 
 *
 * @property int $id
 * @property string $category
 * @property int $item_id
 * @property string $quantity
 * @property int $unit_id
 * @property int $store_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Carbon|null $deleted_at
 * @method static Builder<static>|ItemStockOut newModelQuery()
 * @method static Builder<static>|ItemStockOut newQuery()
 * @method static Builder<static>|ItemStockOut onlyTrashed()
 * @method static Builder<static>|ItemStockOut query()
 * @method static Builder<static>|ItemStockOut whereCategory($value)
 * @method static Builder<static>|ItemStockOut whereCreatedAt($value)
 * @method static Builder<static>|ItemStockOut whereDeletedAt($value)
 * @method static Builder<static>|ItemStockOut whereId($value)
 * @method static Builder<static>|ItemStockOut whereItemId($value)
 * @method static Builder<static>|ItemStockOut whereQuantity($value)
 * @method static Builder<static>|ItemStockOut whereStoreId($value)
 * @method static Builder<static>|ItemStockOut whereUnitId($value)
 * @method static Builder<static>|ItemStockOut whereUpdatedAt($value)
 * @method static Builder<static>|ItemStockOut withTrashed()
 * @method static Builder<static>|ItemStockOut withoutTrashed()
 * @mixin Eloquent
 */
class ItemStockOut extends Model
{
    use SoftDeletes;

    protected $guarded = [];
    protected $table = 'item_stock_out';

}

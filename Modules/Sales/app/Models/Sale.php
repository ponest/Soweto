<?php

namespace Modules\Sales\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;


/**
 * 
 *
 * @property int $id
 * @property int $sales_batch_id
 * @property string $item_type
 * @property int $store_id
 * @property int $ref_id
 * @property string $item_name
 * @property string $unit_price
 * @property string $quantity
 * @property string $total_price
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Carbon|null $deleted_at
 * @method static Builder<static>|Sale newModelQuery()
 * @method static Builder<static>|Sale newQuery()
 * @method static Builder<static>|Sale onlyTrashed()
 * @method static Builder<static>|Sale query()
 * @method static Builder<static>|Sale whereCreatedAt($value)
 * @method static Builder<static>|Sale whereDeletedAt($value)
 * @method static Builder<static>|Sale whereId($value)
 * @method static Builder<static>|Sale whereItemName($value)
 * @method static Builder<static>|Sale whereItemType($value)
 * @method static Builder<static>|Sale whereQuantity($value)
 * @method static Builder<static>|Sale whereRefId($value)
 * @method static Builder<static>|Sale whereSalesBatchId($value)
 * @method static Builder<static>|Sale whereStoreId($value)
 * @method static Builder<static>|Sale whereTotalPrice($value)
 * @method static Builder<static>|Sale whereUnitPrice($value)
 * @method static Builder<static>|Sale whereUpdatedAt($value)
 * @method static Builder<static>|Sale withTrashed()
 * @method static Builder<static>|Sale withoutTrashed()
 * @mixin Eloquent
 */
class Sale extends Model
{
    use SoftDeletes;

    protected $guarded = [];

}

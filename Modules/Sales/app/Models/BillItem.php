<?php

namespace Modules\Sales\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

/**
 * 
 *
 * @property int $id
 * @property int $bill_id
 * @property int|null $store_id
 * @property string $item_name
 * @property string|null $item_description
 * @property string|null $unit_price
 * @property int $quantity
 * @property string $total_price
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Carbon|null $deleted_at
 * @method static Builder<static>|BillItem newModelQuery()
 * @method static Builder<static>|BillItem newQuery()
 * @method static Builder<static>|BillItem onlyTrashed()
 * @method static Builder<static>|BillItem query()
 * @method static Builder<static>|BillItem whereBillId($value)
 * @method static Builder<static>|BillItem whereCreatedAt($value)
 * @method static Builder<static>|BillItem whereDeletedAt($value)
 * @method static Builder<static>|BillItem whereId($value)
 * @method static Builder<static>|BillItem whereItemDescription($value)
 * @method static Builder<static>|BillItem whereItemName($value)
 * @method static Builder<static>|BillItem whereQuantity($value)
 * @method static Builder<static>|BillItem whereStoreId($value)
 * @method static Builder<static>|BillItem whereTotalPrice($value)
 * @method static Builder<static>|BillItem whereUnitPrice($value)
 * @method static Builder<static>|BillItem whereUpdatedAt($value)
 * @method static Builder<static>|BillItem withTrashed()
 * @method static Builder<static>|BillItem withoutTrashed()
 * @mixin \Eloquent
 */
class BillItem extends Model
{
    use SoftDeletes;

    protected $guarded =  [];
}

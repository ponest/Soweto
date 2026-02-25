<?php

namespace Modules\Sales\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;
use Modules\General\Models\Staff;

/**
 * @property int $id
 * @property int $bill_id
 * @property int|null $store_id
 * @property string $item_name
 * @property string|null $item_description
 * @property numeric|null $unit_price
 * @property float $quantity
 * @property numeric $total_price
 * @property string|null $bill_source
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Carbon|null $deleted_at
 * @property int|null $waiter_id
 * @property-read \Modules\Sales\Models\Bill $bill
 * @property-read Staff|null $waiter
 * @method static Builder<static>|BillItem newModelQuery()
 * @method static Builder<static>|BillItem newQuery()
 * @method static Builder<static>|BillItem onlyTrashed()
 * @method static Builder<static>|BillItem query()
 * @method static Builder<static>|BillItem whereBillId($value)
 * @method static Builder<static>|BillItem whereBillSource($value)
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
 * @method static Builder<static>|BillItem whereWaiterId($value)
 * @method static Builder<static>|BillItem withTrashed(bool $withTrashed = true)
 * @method static Builder<static>|BillItem withoutTrashed()
 * @mixin \Eloquent
 */
class BillItem extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    public function bill(): BelongsTo
    {
        return $this->belongsTo(Bill::class);
    }

    public function waiter(): BelongsTo
    {
        return $this->belongsTo(Staff::class, 'waiter_id');
    }

    public static function getWaiterByBillId($billId): string
    {
        $waiterIds = BillItem::whereBillId($billId)->pluck('waiter_id')->toArray();
        $waiterIds = array_unique($waiterIds);
        $waiters = Staff::select(['first_name','last_name'])->whereIn('id', $waiterIds)->get();
        $waiterNames = [];
        foreach ($waiters as $key=>$waiter){
            $waiterNames[$key] = $waiter->full_name;
        }
       return implode(",",$waiterNames);
    }

}

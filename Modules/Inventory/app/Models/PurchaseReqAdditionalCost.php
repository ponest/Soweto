<?php

namespace Modules\Inventory\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

/**
 * 
 *
 * @property int $id
 * @property int $purchase_request_id
 * @property string $cost_item
 * @property string $amount
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Carbon|null $deleted_at
 * @method static Builder<static>|PurchaseReqAdditionalCost newModelQuery()
 * @method static Builder<static>|PurchaseReqAdditionalCost newQuery()
 * @method static Builder<static>|PurchaseReqAdditionalCost onlyTrashed()
 * @method static Builder<static>|PurchaseReqAdditionalCost query()
 * @method static Builder<static>|PurchaseReqAdditionalCost whereAmount($value)
 * @method static Builder<static>|PurchaseReqAdditionalCost whereCostItem($value)
 * @method static Builder<static>|PurchaseReqAdditionalCost whereCreatedAt($value)
 * @method static Builder<static>|PurchaseReqAdditionalCost whereDeletedAt($value)
 * @method static Builder<static>|PurchaseReqAdditionalCost whereId($value)
 * @method static Builder<static>|PurchaseReqAdditionalCost wherePurchaseRequestId($value)
 * @method static Builder<static>|PurchaseReqAdditionalCost whereUpdatedAt($value)
 * @method static Builder<static>|PurchaseReqAdditionalCost withTrashed()
 * @method static Builder<static>|PurchaseReqAdditionalCost withoutTrashed()
 * @mixin \Eloquent
 */
class PurchaseReqAdditionalCost extends Model
{
    use SoftDeletes;

    protected $guarded  = [];

    public static function isExist($costItem, $purchaseReqId): PurchaseReqAdditionalCost|null
    {
        return PurchaseReqAdditionalCost::where([['cost_item', $costItem], ['purchase_request_id', $purchaseReqId]])->first();
    }

    public static function isExistOnEdit($costItem, $purchaseReqId, $id): PurchaseReqAdditionalCost|null
    {
        return PurchaseReqAdditionalCost::where([['cost_item', $costItem], ['purchase_request_id', $purchaseReqId], ['id', '!=', $id]])->first();
    }

}

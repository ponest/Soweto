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
 * @property int $stock_issue_id
 * @property string $requisition_number
 * @property int $item_id
 * @property float $quantity
 * @property int $unit_id
 * @property string $issued_at
 * @property int $stock_requisition_item_id
 * @property int $department_id
 * @property int|null $store_id
 * @property int|null $issuing_store_id
 * @property int $is_received
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Carbon|null $deleted_at
 * @method static Builder<static>|StockIssueItem newModelQuery()
 * @method static Builder<static>|StockIssueItem newQuery()
 * @method static Builder<static>|StockIssueItem onlyTrashed()
 * @method static Builder<static>|StockIssueItem query()
 * @method static Builder<static>|StockIssueItem whereCreatedAt($value)
 * @method static Builder<static>|StockIssueItem whereDeletedAt($value)
 * @method static Builder<static>|StockIssueItem whereDepartmentId($value)
 * @method static Builder<static>|StockIssueItem whereId($value)
 * @method static Builder<static>|StockIssueItem whereIsReceived($value)
 * @method static Builder<static>|StockIssueItem whereIssuedAt($value)
 * @method static Builder<static>|StockIssueItem whereIssuingStoreId($value)
 * @method static Builder<static>|StockIssueItem whereItemId($value)
 * @method static Builder<static>|StockIssueItem whereQuantity($value)
 * @method static Builder<static>|StockIssueItem whereRequisitionNumber($value)
 * @method static Builder<static>|StockIssueItem whereStockIssueId($value)
 * @method static Builder<static>|StockIssueItem whereStockRequisitionItemId($value)
 * @method static Builder<static>|StockIssueItem whereStoreId($value)
 * @method static Builder<static>|StockIssueItem whereUnitId($value)
 * @method static Builder<static>|StockIssueItem whereUpdatedAt($value)
 * @method static Builder<static>|StockIssueItem withTrashed()
 * @method static Builder<static>|StockIssueItem withoutTrashed()
 * @mixin \Eloquent
 */
class StockIssueItem extends Model
{
    use SoftDeletes;

    protected $guarded = [];

}

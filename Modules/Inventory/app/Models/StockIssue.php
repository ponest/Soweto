<?php

namespace Modules\Inventory\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;
use Modules\Auth\Models\User;
use Modules\Setups\Models\Department;

/**
 * 
 *
 * @property int $id
 * @property int $stock_requisition_id
 * @property string $issue_number
 * @property string $requisition_number
 * @property int $issued_by
 * @property string $issued_at
 * @property int|null $received_by
 * @property string|null $received_at
 * @property int $department_id
 * @property int|null $store_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Carbon|null $deleted_at
 * @property-read Department $department
 * @property-read User $issuedBy
 * @method static Builder<static>|StockIssue newModelQuery()
 * @method static Builder<static>|StockIssue newQuery()
 * @method static Builder<static>|StockIssue onlyTrashed()
 * @method static Builder<static>|StockIssue query()
 * @method static Builder<static>|StockIssue whereCreatedAt($value)
 * @method static Builder<static>|StockIssue whereDeletedAt($value)
 * @method static Builder<static>|StockIssue whereDepartmentId($value)
 * @method static Builder<static>|StockIssue whereId($value)
 * @method static Builder<static>|StockIssue whereIssueNumber($value)
 * @method static Builder<static>|StockIssue whereIssuedAt($value)
 * @method static Builder<static>|StockIssue whereIssuedBy($value)
 * @method static Builder<static>|StockIssue whereReceivedAt($value)
 * @method static Builder<static>|StockIssue whereReceivedBy($value)
 * @method static Builder<static>|StockIssue whereRequisitionNumber($value)
 * @method static Builder<static>|StockIssue whereStockRequisitionId($value)
 * @method static Builder<static>|StockIssue whereStoreId($value)
 * @method static Builder<static>|StockIssue whereUpdatedAt($value)
 * @method static Builder<static>|StockIssue withTrashed()
 * @method static Builder<static>|StockIssue withoutTrashed()
 * @mixin \Eloquent
 */
class StockIssue extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    protected $table = 'stock_issue';

    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class);
    }

    public function issuedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'issued_by');
    }
}

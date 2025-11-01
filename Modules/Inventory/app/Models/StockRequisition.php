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
 * @property string $description
 * @property string $requisition_number
 * @property string $status
 * @property int|null $department_id
 * @property int|null $store_id
 * @property string|null $submitted_at
 * @property int|null $submitted_by
 * @property string|null $reviewed_at
 * @property int|null $reviewed_by
 * @property int|null $is_approved
 * @property string|null $issued_at
 * @property int|null $issued_by
 * @property string|null $received_at
 * @property int|null $received_by
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Carbon|null $deleted_at
 * @property string|null $reject_comments
 * @property-read Department|null $department
 * @property-read User|null $reviewedBy
 * @property-read User|null $submittedBy
 * @method static Builder<static>|StockRequisition newModelQuery()
 * @method static Builder<static>|StockRequisition newQuery()
 * @method static Builder<static>|StockRequisition onlyTrashed()
 * @method static Builder<static>|StockRequisition query()
 * @method static Builder<static>|StockRequisition whereCreatedAt($value)
 * @method static Builder<static>|StockRequisition whereDeletedAt($value)
 * @method static Builder<static>|StockRequisition whereDepartmentId($value)
 * @method static Builder<static>|StockRequisition whereDescription($value)
 * @method static Builder<static>|StockRequisition whereId($value)
 * @method static Builder<static>|StockRequisition whereIsApproved($value)
 * @method static Builder<static>|StockRequisition whereIssuedAt($value)
 * @method static Builder<static>|StockRequisition whereIssuedBy($value)
 * @method static Builder<static>|StockRequisition whereReceivedAt($value)
 * @method static Builder<static>|StockRequisition whereReceivedBy($value)
 * @method static Builder<static>|StockRequisition whereRejectComments($value)
 * @method static Builder<static>|StockRequisition whereRequisitionNumber($value)
 * @method static Builder<static>|StockRequisition whereReviewedAt($value)
 * @method static Builder<static>|StockRequisition whereReviewedBy($value)
 * @method static Builder<static>|StockRequisition whereStatus($value)
 * @method static Builder<static>|StockRequisition whereStoreId($value)
 * @method static Builder<static>|StockRequisition whereSubmittedAt($value)
 * @method static Builder<static>|StockRequisition whereSubmittedBy($value)
 * @method static Builder<static>|StockRequisition whereUpdatedAt($value)
 * @method static Builder<static>|StockRequisition withTrashed()
 * @method static Builder<static>|StockRequisition withoutTrashed()
 * @mixin \Eloquent
 */
class StockRequisition extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    public static function isExist($description)
    {
        return self:: where('description', $description)->first();
    }

    public static function isExistOnEdit($description, $id)
    {
        return self::where([['description', $description], ['id', '!=', $id]])->first();
    }

    public function submittedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'submitted_by');
    }

    public function reviewedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'reviewed_by');
    }

    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class);
    }

    public function store(): BelongsTo
    {
        return $this->belongsTo(Store::class);
    }
}

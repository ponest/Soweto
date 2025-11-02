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
 * @property string $batch_number
 * @property int|null $client_id
 * @property string|null $client_type
 * @property int|null $room_id
 * @property string $total_price
 * @property int $created_by
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Carbon|null $deleted_at
 * @property string|null $source
 * @property int $is_paid
 * @method static Builder<static>|SalesBatch newModelQuery()
 * @method static Builder<static>|SalesBatch newQuery()
 * @method static Builder<static>|SalesBatch onlyTrashed()
 * @method static Builder<static>|SalesBatch query()
 * @method static Builder<static>|SalesBatch whereBatchNumber($value)
 * @method static Builder<static>|SalesBatch whereClientId($value)
 * @method static Builder<static>|SalesBatch whereClientType($value)
 * @method static Builder<static>|SalesBatch whereCreatedAt($value)
 * @method static Builder<static>|SalesBatch whereCreatedBy($value)
 * @method static Builder<static>|SalesBatch whereDeletedAt($value)
 * @method static Builder<static>|SalesBatch whereId($value)
 * @method static Builder<static>|SalesBatch whereIsPaid($value)
 * @method static Builder<static>|SalesBatch whereRoomId($value)
 * @method static Builder<static>|SalesBatch whereSource($value)
 * @method static Builder<static>|SalesBatch whereTotalPrice($value)
 * @method static Builder<static>|SalesBatch whereUpdatedAt($value)
 * @method static Builder<static>|SalesBatch withTrashed()
 * @method static Builder<static>|SalesBatch withoutTrashed()
 * @mixin \Eloquent
 */
class SalesBatch extends Model
{
    use SoftDeletes;

    protected $guarded  = [];

}

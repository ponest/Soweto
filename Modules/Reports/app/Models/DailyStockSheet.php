<?php

namespace Modules\Reports\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property int $id
 * @property int $stock_item_id
 * @property int $store_id
 * @property numeric $opening_stock
 * @property numeric $additional_stock
 * @property numeric $total_stock
 * @property numeric $closing_stock
 * @property numeric $sold_qty
 * @property numeric $unit_price
 * @property numeric $total_price
 * @property string $date
 * @property numeric $day
 * @property string $month
 * @property string $year
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @method static Builder<static>|DailyStockSheet newModelQuery()
 * @method static Builder<static>|DailyStockSheet newQuery()
 * @method static Builder<static>|DailyStockSheet onlyTrashed()
 * @method static Builder<static>|DailyStockSheet query()
 * @method static Builder<static>|DailyStockSheet whereAdditionalStock($value)
 * @method static Builder<static>|DailyStockSheet whereClosingStock($value)
 * @method static Builder<static>|DailyStockSheet whereCreatedAt($value)
 * @method static Builder<static>|DailyStockSheet whereDate($value)
 * @method static Builder<static>|DailyStockSheet whereDay($value)
 * @method static Builder<static>|DailyStockSheet whereDeletedAt($value)
 * @method static Builder<static>|DailyStockSheet whereId($value)
 * @method static Builder<static>|DailyStockSheet whereMonth($value)
 * @method static Builder<static>|DailyStockSheet whereOpeningStock($value)
 * @method static Builder<static>|DailyStockSheet whereSoldQty($value)
 * @method static Builder<static>|DailyStockSheet whereStockItemId($value)
 * @method static Builder<static>|DailyStockSheet whereStoreId($value)
 * @method static Builder<static>|DailyStockSheet whereTotalPrice($value)
 * @method static Builder<static>|DailyStockSheet whereTotalStock($value)
 * @method static Builder<static>|DailyStockSheet whereUnitPrice($value)
 * @method static Builder<static>|DailyStockSheet whereUpdatedAt($value)
 * @method static Builder<static>|DailyStockSheet whereYear($value)
 * @method static Builder<static>|DailyStockSheet withTrashed(bool $withTrashed = true)
 * @method static Builder<static>|DailyStockSheet withoutTrashed()
 * @mixin \Eloquent
 */
class DailyStockSheet extends Model
{
    use SoftDeletes;

    protected $guarded = [];

}

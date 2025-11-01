<?php

namespace Modules\Inventory\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;
use Modules\Setups\Models\Unit;


/**
 *
 * @property int $id
 * @property int $item_id
 * @property int $from_unit_id
 * @property int $to_unit_id
 * @property int $multiplier
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Carbon|null $deleted_at
 * @property-read Unit $fromUnit
 * @property-read \Modules\Inventory\Models\StockItem $item
 * @property-read Unit $toUnit
 * @method static Builder<static>|ItemUnitConversion newModelQuery()
 * @method static Builder<static>|ItemUnitConversion newQuery()
 * @method static Builder<static>|ItemUnitConversion onlyTrashed()
 * @method static Builder<static>|ItemUnitConversion query()
 * @method static Builder<static>|ItemUnitConversion whereCreatedAt($value)
 * @method static Builder<static>|ItemUnitConversion whereDeletedAt($value)
 * @method static Builder<static>|ItemUnitConversion whereFromUnitId($value)
 * @method static Builder<static>|ItemUnitConversion whereId($value)
 * @method static Builder<static>|ItemUnitConversion whereItemId($value)
 * @method static Builder<static>|ItemUnitConversion whereMultiplier($value)
 * @method static Builder<static>|ItemUnitConversion whereToUnitId($value)
 * @method static Builder<static>|ItemUnitConversion whereUpdatedAt($value)
 * @method static Builder<static>|ItemUnitConversion withTrashed()
 * @method static Builder<static>|ItemUnitConversion withoutTrashed()
 * @mixin \Eloquent
 */
class ItemUnitConversion extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    public static function isExist($item_id, $from_unit, $to_unit)
    {
        return self:: where([['item_id', $item_id], ['from_unit_id', $from_unit], ['to_unit_id', $to_unit]])->first();
    }

    public static function isExistOnEdit($item_id, $from_unit, $to_unit, $id)
    {
        return self::where([['item_id', $item_id], ['from_unit_id', $from_unit], ['to_unit_id', $to_unit], ['id', '!=', $id]])->first();
    }

    public function fromUnit(): BelongsTo
    {
        return $this->belongsTo(Unit::class);
    }

    public function toUnit(): BelongsTo
    {
        return $this->belongsTo(Unit::class);
    }

    public function item(): BelongsTo
    {
        return $this->belongsTo(StockItem::class);
    }

    public static function getConversion($item_id, $bulk_unit_id)
    {
        return self::where('item_id', $item_id)
            ->where('from_unit_id', $bulk_unit_id)->first();
    }
}

<?php declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class GeneralEnum extends Enum
{
    const HouseKeepingStoreId = 5;
    const TotsUnitId = 9;
    const GlassUnitId = 10;

    const BarUnitsArray = array(5, 9, 10);
}

<?php declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;

final class GeneralEnum extends Enum
{
//    const HouseKeepingStoreId = 5;
    const HouseKeepingStoreId = 3;
    const KitchenStoreId = 3;
//    const KitchenStoreId = 6;
//    const TotsUnitId = 9;
    const TotsUnitId = 14;
//    const GlassUnitId = 10;
    const GlassUnitId = 12;
//    const BarUnitsArray = array(5, 9, 10);
    const BarUnitsArray = array(3, 14, 12);
    const StockSheetStoreArray = array(5);
}

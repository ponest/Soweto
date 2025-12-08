<?php declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;

final class StockOutCategories extends Enum
{
    const ROOM_CONSUMPTION = "RoomConsumption";
    const TRANSFER = "Transfer";
    const SALES = "Sales";
    const KITCHEN_CONSUMPTION = "KitchenConsumption";
}

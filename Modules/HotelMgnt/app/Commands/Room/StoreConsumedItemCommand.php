<?php

namespace Modules\HotelMgnt\Commands\Room;

use App\Enums\GeneralEnum;
use App\Enums\StockOutCategories;
use Exception;
use Illuminate\Support\Facades\Log;
use Modules\HotelMgnt\Models\Room;
use Modules\HotelMgnt\Models\RoomItem;
use Modules\Sales\Commands\Sales\SaveStockOutCommand;

class StoreConsumedItemCommand
{
    public static function handle(): void
    {
        try {
            $rooms = Room::where('status', 'Occupied')->get();
            foreach ($rooms as $room) {
                $roomItems = RoomItem::where('room_id', $room->id)->get();
                foreach ($roomItems as $roomItem) {
                    $item['itemId'] = $roomItem->stock_item_id;
                    $item['quantity'] = $roomItem->quantity;
                    SaveStockOutCommand::handle($item, GeneralEnum::HouseKeepingStoreId, StockOutCategories::ROOM_CONSUMPTION);
                }
            }
            Log::info("Successfully saved consumed items");
        } catch (Exception $exception) {
            Log::error("Consumed Items Error");
            Log::error($exception->getMessage());
        }
    }
}

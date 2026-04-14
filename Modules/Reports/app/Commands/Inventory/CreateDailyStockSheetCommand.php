<?php

namespace Modules\Reports\Commands\Inventory;

use App\Enums\GeneralEnum;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Modules\Inventory\Models\ItemStockIn;
use Modules\Inventory\Models\ItemStockOut;
use Modules\Inventory\Models\Store;
use Modules\Inventory\Models\StoreItem;
use Modules\Reports\Models\DailyStockSheet;
use Modules\Sales\Models\ItemPrice;

class CreateDailyStockSheetCommand
{
    public static function handle(): void
    {
        Log::info("Start Create Daily Stock Sheet Command");

        $date = Carbon::yesterday();
        $dayBeforeYesterday = $date->copy()->subDay()->format('Y-m-d');

        $rangeStart = $date->copy()->startOfDay();
        $rangeEnd = $date->copy()->endOfDay();

        $stores = Store::whereIn('id', GeneralEnum::StockSheetStoreArray)->get();

        foreach ($stores as $store) {

            DB::transaction(function () use ($store, $date, $dayBeforeYesterday, $rangeStart, $rangeEnd) {

                $storeItems = StoreItem::where('store_id', $store->id)->get();

                foreach ($storeItems as $storeItem) {

                    // 🔹 Yesterday stock sheet
                    $yesterdayStockSheet = DailyStockSheet::where('store_id', $store->id)
                        ->where('stock_item_id', $storeItem->item_id)
                        ->where('date', $dayBeforeYesterday)
                        ->first();

                    // 🔹 Stock In (yesterday)
                    $stockInQty = ItemStockIn::where('item_id', $storeItem->item_id)
                        ->where('store_id', $store->id)
                        ->whereDate('received_date', $date)
                        ->sum('quantity');

                    // 🔹 Base Stock Out Query
                    $stockOutQuery = ItemStockOut::where('item_id', $storeItem->item_id)
                        ->where('store_id', $store->id)
                        ->whereBetween('created_at', [$rangeStart, $rangeEnd]);

                    $stockOutQty = (clone $stockOutQuery)->sum('quantity');

                    $soldOutQty = (clone $stockOutQuery)
                        ->where('category', 'Sales')
                        ->sum('quantity');

                    // 🔹 Opening & Closing Stock
                    if ($yesterdayStockSheet) {
                        $openingStock = $yesterdayStockSheet->closing_stock;
                        $closingStock = $openingStock - $stockOutQty;
                    }else{
                        $openingStock = null;

                        $totalReceived = ItemStockIn::where([['store_id',$store->id],['item_id',$storeItem->item_id]])->sum('quantity');
                        $totalIssued = ItemStockOut::where([['store_id',$store->id],['item_id',$storeItem->item_id]])
                            ->whereDate('created_at','<=', $date)->sum('quantity');

                        $closingStock = $totalReceived - $totalIssued;
                    }

                    // 🔹 Price
                    $unitPrice = ItemPrice::where('item_id', $storeItem->item_id)
                        ->where('is_active', true)
                        ->value('price') ?? 0;

                    // 🔹 Save (idempotent)
                    DailyStockSheet::updateOrCreate(
                        [
                            'date' => $date->format('Y-m-d'),
                            'store_id' => $store->id,
                            'stock_item_id' => $storeItem->item_id,
                        ],
                        [
                            'day' => $date->format('d'),
                            'month' => $date->format('m'),
                            'year' => $date->format('Y'),
                            'opening_stock' => $openingStock,
                            'additional_stock' => $stockInQty,
                            'total_stock' => $openingStock + $stockInQty,
                            'closing_stock' => $closingStock,
                            'sold_qty' => $soldOutQty,
                            'unit_price' => $unitPrice,
                            'total_price' => $unitPrice * $soldOutQty,
                        ]
                    );
                }

            });
        }

        Log::info("Daily Stock Sheet Created");
    }
}

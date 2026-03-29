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
//    public static function handle(): void
//    {
//        Log::info("Start CreateDailyStockSheetCommand");
//
//        $date = Carbon::yesterday();
//        $dayBeforeYesterday = Carbon::now()->subDays(2)->format('Y-m-d');
//
//        $stores = Store::whereIn('id', array(5))->get();
//
//        foreach ($stores as $store) {
//            $store_items = StoreItem::whereStoreId($store->id)->get();
//            foreach ($store_items as $store_item) {
//
//                $yesterdayStockSheet = DailyStockSheet::where('store_id', $store->id)
//                    ->where('stock_item_id', $store_item->item_id)
//                    ->where('date', $dayBeforeYesterday)
//                    ->first();
//
//                $stockInQty = ItemStockIn::where('item_id', $store_item->item_id)
//                    ->where('store_id', $store->id)
//                    ->where('received_date', '=', $date)
//                    ->sum('quantity');
//
//                $stockOutQty = ItemStockOut::where('item_id', $store_item->item_id)
//                    ->where('store_id', $store->id)
//                    ->whereBetween('created_at', [
//                        $date->startOfDay(),
//                        $date->endOfDay()
//                    ])
//                    ->sum('quantity');
//
//                $soldOutQty = ItemStockOut::where('item_id', $store_item->item_id)
//                    ->where('store_id', $store->id)
//                    ->whereBetween('created_at', [
//                        $date->startOfDay(),
//                        $date->endOfDay()
//                    ])
//                    ->where('category','Sales')
//                    ->sum('quantity');
//
//
//                if ($yesterdayStockSheet) {
//                    $openingStock = $yesterdayStockSheet->closing_stock;
//                    $closingStock = $openingStock - $stockOutQty;
//                }else{
//                    $openingStock = null;
//
//                    $totalReceived = ItemStockIn::where([['store_id',$store->id],['item_id',$store_item->item_id]])->sum('quantity');
//                    $totalIssued = ItemStockOut::where([['store_id',$store->id],['item_id',$store_item->item_id]])
//                        ->whereDate('created_at','<=', $date)->sum('quantity');
//
//                    $closingStock = $totalReceived - $totalIssued;
//                }
//
//                $itemPrice = ItemPrice::where('item_id', $store_item->item_id)
//                    ->where('is_active',true)->first();
//
//
//                $dailyStockSheet = new DailyStockSheet();
//                $dailyStockSheet->date = $date->format('Y-m-d');
//                $dailyStockSheet->day = $date->format('d');
//                $dailyStockSheet->month = $date->format('m');
//                $dailyStockSheet->year = $date->format('Y');
//                $dailyStockSheet->store_id = $store->id;
//                $dailyStockSheet->stock_item_id = $store_item->item_id;
//                $dailyStockSheet->opening_stock = $openingStock;
//                $dailyStockSheet->additional_stock = $stockInQty;
//                $dailyStockSheet->total_stock = $dailyStockSheet->opening_stock + $stockInQty;
//                $dailyStockSheet->closing_stock = $closingStock;
//                $dailyStockSheet->sold_qty = $soldOutQty;
//                $dailyStockSheet->unit_price = $itemPrice ? $itemPrice->price : 0;
//                $dailyStockSheet->total_price = $dailyStockSheet->unit_price * $soldOutQty;
//
//                $dailyStockSheet->save();
//            }
//        }
//
//        Log::info("Daily Stock Sheet Created");
//    }


    public static function handle(): void
    {
        Log::info("Start Create Daily Stock Sheet Command");

        $date = Carbon::yesterday();
        $dayBeforeYesterday = $date->copy()->subDay()->format('Y-m-d');

        $rangeStart = $date->copy()->startOfDay();
        $rangeEnd = $date->copy()->endOfDay();

//        $stores = Store::whereIn('id', [5])->get();
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

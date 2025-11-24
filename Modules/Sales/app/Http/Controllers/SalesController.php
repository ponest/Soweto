<?php

namespace Modules\Sales\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Modules\Auth\Models\User;
use Modules\HotelMgnt\Models\Booking;
use Modules\HotelMgnt\Models\Client;
use Modules\Inventory\Models\StockItem;
use Modules\Inventory\Models\StoreItem;
use Modules\Sales\Commands\Sales\SaveBillCommand;
use Modules\Sales\Commands\Sales\SaveBillItemsCommand;
use Modules\Sales\Commands\Sales\SaveBookingChargesCommand;
use Modules\Sales\Commands\Sales\SaveSalesBatchCommand;
use Modules\Sales\Commands\Sales\SaveSalesCommand;
use Modules\Sales\Commands\Sales\SaveStockOutCommand;
use Modules\Sales\Models\Bill;
use Modules\Sales\Models\FoodMenu;
use Modules\Sales\Models\Sale;

class SalesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($category)
    {
        if ($category === 'bar') {
            $storeId = User::userStoreId();
            $itemsArray = StoreItem::whereStoreId($storeId)->pluck('item_id')->toArray();
            $params['stock_items'] = StockItem::whereIn('id', $itemsArray)->orderBy('name')->get();
        } elseif ($category === 'kitchen') {
            $params['stock_items'] = FoodMenu::orderBy('name')->get();
        } else {
            $params['stock_items'] = [];
        }
        $params['category'] = $category;
        $client_ids = Booking::whereBookingStatus('CheckedIn')->pluck('client_id')->toArray();
        $params['clients'] = Client::whereIn('id', $client_ids)->get();
        return view('sales::sales.index', $params);
    }

    public function itemSales(Request $request)
    {
        return DB::transaction(function () use ($request) {
            $cart = $request->input('cart');
            $grandTotal = $request->input('grand_total');
            $category = $request->input('category');
            $clientId = $request->input('client_id');
            $isAccommodation = $request->input('is_accommodation');
            $booking = null;

            if ($clientId != null) {
                $booking = Booking::whereClientId($clientId)->where('booking_status', 'CheckedIn')->first();
            }

            if (empty($cart)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Cart is empty'], 400);
            }
            //Check if Balance Exists
            $storeId = User::userStoreId();

            if ($category === 'bar') {
                foreach ($cart as $item) {
                    $itemInfo = StoreItem::stockBalance($storeId, $item['itemId']);
                    if ($itemInfo['balance'] < $item['quantity']) {
                        return response()->json([
                            'success' => false,
                            'message' => 'Balance is not enough!'
                        ]);
                    }
                    //Save to Item Stock Out
                    SaveStockOutCommand::handle($item, $storeId);
                }
            }
            // Save Sale Batch
            $sale_batch = SaveSalesBatchCommand::handle($grandTotal, $category, $booking);

            //Save to Bills Table
            if ($booking) {
                //if bill exist
                $billExist = Bill::whereBookingId($booking->id)->first();
                if ($billExist) {
                    $bill = $billExist;
                } else {
                    $bill = SaveBillCommand::handle($sale_batch, $grandTotal, $booking);
                }
            } else {
                $bill = SaveBillCommand::handle($sale_batch, $grandTotal, $booking);
            }

            foreach ($cart as $item) {
                SaveSalesCommand::handle($item, $storeId, $sale_batch);

                if ($isAccommodation == 'Yes') {
                    //Save to Booking Charges
                    if ($booking != null) {
                        SaveBookingChargesCommand::handle($item, $category, $booking);
                    }
                }

                //Save Bill Items
                SaveBillItemsCommand::handle($bill, $item, $storeId);
            }

            return response()->json([
                'success' => true,
                'message' => 'Sales successful!'
            ]);
        });
    }

    public function salesHistory()
    {
        $storeId = User::userStoreId();
        if (Gate::allows('Cashier')) {
            $params['items'] = Sale::join('sales_batches as sl', 'sl.id', '=', 'sales.sales_batch_id')
                ->where('is_paid', true)
                ->select('sales.*')->latest()->get();
        } else {
            $params['items'] = Sale::join('sales_batches as sl', 'sl.id', '=', 'sales.sales_batch_id')
                ->where('store_id', $storeId)->where('is_paid', true)
                ->select('sales.*')->latest()->get();
        }

        return view('sales::sales.sales_history', $params);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return view('sales::edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
    }
}

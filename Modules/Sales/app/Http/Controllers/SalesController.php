<?php

namespace Modules\Sales\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Modules\Auth\Models\User;
use Modules\HotelMgnt\Models\Booking;
use Modules\HotelMgnt\Models\BookingCharges;
use Modules\HotelMgnt\Models\Client;
use Modules\Inventory\Models\ItemStockOut;
use Modules\Inventory\Models\StockItem;
use Modules\Inventory\Models\StoreItem;
use Modules\Sales\Models\Bill;
use Modules\Sales\Models\BillItem;
use Modules\Sales\Models\FoodMenu;
use Modules\Sales\Models\Sale;
use Modules\Sales\Models\SalesBatch;

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

//                    if ($category === 'bar') {
                        //Save to Item Stock Out
                        $unitId = StockItem::find($item['itemId'])->unit_id;
                        $itemStockOut = new ItemStockOut();
                        $itemStockOut->item_id = $item['itemId'];
                        $itemStockOut->quantity = $item['quantity'];
                        $itemStockOut->category = "Sales";
                        $itemStockOut->unit_id = $unitId;
                        $itemStockOut->store_id = $storeId;
                        $itemStockOut->save();
//                    }
                }
            }

            // Example: Save sale and items
            $sale_batch = SalesBatch::create([
                'batch_number' => 'SL-' . now()->timestamp,
                'total_price' => $grandTotal,
                'created_by' => auth()->id(),
                'source' => ucwords($category),
                'room_id' => $booking?->room_id,
                'client_id' => $booking?->client_id,
                'client_type' => $booking ? 'Hotel Guest' : null,
            ]);


            //Save to Bills Table
            if ($isAccommodation == 'No') {
                $departmentId = User::currentUserDepartmentId();
                $bill = new Bill();
                $bill->reference_no = "BILL-" . now()->timestamp;
                $bill->ref_id = $sale_batch->id;
                $bill->category = "Sales";
                $bill->bill_amount = $grandTotal;
                $bill->issued_by = auth()->id();
                $bill->issued_at = now();
                $bill->department_id = $departmentId;
                $bill->save();
            }

            foreach ($cart as $item) {
                Sale::create([
                    'sales_batch_id' => $sale_batch->id,
                    'unit_price' => $item['price'],
                    'quantity' => $item['quantity'],
                    'total_price' => $item['total'],
                    'ref_id' => $item['itemId'],
                    'item_name' => $item['itemName'],
                    'store_id' => $storeId,
                ]);



                if ($isAccommodation == 'Yes') {
                    //Save to Booking Charges
                    if ($booking != null) {
                        $bookingCharges = new BookingCharges();
                        $bookingCharges->booking_id = $booking->id;
                        $bookingCharges->type = $category == 'bar' ? 'Beverage Charges' : 'Meal Charges';
                        $bookingCharges->description = $item['itemName'];
                        $bookingCharges->unit_price = $item['price'];
                        $bookingCharges->quantity = $item['quantity'];
                        $bookingCharges->total_price = $item['total'];
                        $bookingCharges->expense_date = date('Y-m-d');
                        $bookingCharges->save();
                    }
                }

                if ($isAccommodation == 'No') {
                    //Save Bill Items
                    $billItem = new BillItem();
                    $billItem->bill_id = $bill->id;
                    $billItem->item_name = $item['itemName'];
                    $billItem->unit_price = $item['price'];
                    $billItem->quantity = $item['quantity'];
                    $billItem->total_price = $item['total'];
                    $billItem->save();
                }

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
        $params['items'] = Sale::join('sales_batches as sl', 'sl.id','=','sales.sales_batch_id')
        ->where('store_id',$storeId)->where('is_paid',true)
            ->select('sales.*')->latest()->get();
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

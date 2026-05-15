<?php

namespace Modules\Sales\Http\Controllers;

use App\Enums\GeneralEnum;
use App\Enums\StockOutCategories;
use App\Exports\ExpSalesReport;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Maatwebsite\Excel\Facades\Excel;
use Modules\Auth\Models\User;
use Modules\General\Models\Ingredient;
use Modules\General\Models\Staff;
use Modules\HotelMgnt\Models\Booking;
use Modules\HotelMgnt\Models\Client;
use Modules\Inventory\Models\ItemUnitConversion;
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
use Modules\Sales\Models\Payment;
use Modules\Sales\Models\Sale;
use Modules\Setups\Models\Unit;

class SalesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($category)
    {
        $params['category'] = $category;
        $params['staffs'] = Staff::where('staff_role_id', GeneralEnum::WaiterStaffRoleId)->orderBy('first_name')->get();
//        $client_ids = Booking::whereBookingStatus('CheckedIn')->pluck('client_id')->toArray();
//        $params['clients'] = Client::whereIn('id', $client_ids)->get();
        $params['bookings'] = Booking::whereBookingStatus('CheckedIn')->get();

        if ($category === 'bar') {
            $storeId = User::userStoreId();
            $itemsArray = StoreItem::whereStoreId($storeId)->pluck('item_id')->toArray();
            $params['stock_items'] = StockItem::whereIn('id', $itemsArray)->orderBy('name')->get();
            $params['units'] = Unit::whereIn('id', GeneralEnum::BarUnitsArray)->get();
            return view('sales::sales.bar_sales_index', $params);
        } elseif ($category === 'kitchen') {
//            $menu_ids = Ingredient::distinct()->pluck('menu_id');
            $menus = FoodMenu::orderBy('name')->get();
            $params['stock_items'] = $menus;
            $params['companies'] = $menus->where('is_company', true);
            return view('sales::sales.kitchen_sales_index', $params);
        } else {
            $params['stock_items'] = [];
            return view('sales::sales.kitchen_sales_index', $params);
        }
    }

    public function itemSales(Request $request)
    {
        try {
            return DB::transaction(function () use ($request) {
                $cart = $request->input('cart');
                $grandTotal = $request->input('grand_total');
                $category = $request->input('category');
                $clientId = $request->input('client_id');
                $isAccommodation = $request->input('is_accommodation');
                $isAdditionBill = $request->input('is_addition_bill');
                $staffId = $request->input('staff_id');
                $billRefNo = $request->input('bill_ref_no');
                $booking = null;

                if ($isAdditionBill == 'Yes') {
                    $billInfo = Bill::where('reference_no', $billRefNo)
                        ->where('status', '=', 'unpaid')->first();
                    if (!$billInfo) {
                        throw new Exception('Bill Reference Number is not found or is Already Paid');
//                        return response()->json([
//                            'success' => false,
//                            'message' => 'Bill Reference Number is not found or is Already Paid'], 400);
                    }
                }

                if ($clientId != null) {
                    $booking = Booking::whereClientId($clientId)->where('booking_status', 'CheckedIn')->first();
                }

                if (empty($cart)) {
                    throw new Exception('Cart is empty');
                }
                //Check if Balance Exists
                $storeId = User::userStoreId();

                if ($category === 'bar') {
                    foreach ($cart as $item) {
                        $itemInfo = StoreItem::stockBalance($storeId, $item['itemId']);
                        if ($item['unitId'] == 9) { //tots
                            $unitConv = ItemUnitConversion::where('item_id', $item['itemId'])
                                ->where('to_unit_id', $item['unitId'])->first();
                            $item['quantity'] = $item['quantity'] / $unitConv->multiplier;
                        }

                        if ($item['unitId'] == 10) { //glasses
                            $unitConv = ItemUnitConversion::where('item_id', $item['itemId'])
                                ->where('to_unit_id', $item['unitId'])->first();
                            $item['quantity'] = $item['quantity'] / $unitConv->multiplier;
                        }

                        if ($itemInfo['balance'] < $item['quantity']) {
                            throw new Exception('Balance is not enough!');
                        }
                        //Save to Item Stock Out
                        SaveStockOutCommand::handle($item, $storeId, StockOutCategories::SALES);
                    }
                }

//                if ($category === 'kitchen') {
//                    foreach ($cart as $item) {
//                        $ingredients = Ingredient::whereMenuId($item['itemId'])->get();
//                        if (count($ingredients) == 0) {
//                            throw new Exception('Ingredient not found!');
//                        }
//                        foreach ($ingredients as $ingredient) {
//
//                            $itemData['itemId'] = $ingredient->stock_item_id;
//                            $itemData['quantity'] = $ingredient->quantity * $item['quantity'];
//                            //Check if Balance is Enough
//                            $itemInfo = StoreItem::stockBalance($storeId, $itemData['itemId']);
//                            if ($itemInfo['balance'] < $item['quantity']) {
//                                throw new Exception('Balance is not enough!');
//                            }
//                            //Save to Item Stock Out
//                            SaveStockOutCommand::handle($itemData, $storeId, StockOutCategories::SALES);
//                        }
//                    }
//                }

                // Save Sale Batch
                $sale_batch = SaveSalesBatchCommand::handle($grandTotal, $category, $booking);

                //Save to Bills Table
                if ($booking) {
                    //if bill exists
                    $billExist = Bill::whereBookingId($booking->id)->first();
                    if ($billExist) {
                        $bill = $billExist;
                    } else {
                        $bill = SaveBillCommand::handle($sale_batch, $grandTotal, $booking);
                    }
                } else {
                    if ($isAdditionBill == 'Yes') {
                        $bill = $billInfo;
                    } else {
                        $bill = SaveBillCommand::handle($sale_batch, $grandTotal, $booking);
                    }
                }

                foreach ($cart as $item) {
                    SaveSalesCommand::handle($item, $storeId, $sale_batch, $staffId);
                    if ($isAccommodation == 'Yes') {
                        //Save to Booking Charges
                        if ($booking != null) {
                            SaveBookingChargesCommand::handle($item, $category, $booking);
                        }
                    }
                    //Save Bill Items
                    SaveBillItemsCommand::handle($bill, $item, $storeId, $staffId);
                }

                return response()->json([
                    'success' => true,
                    'message' => 'Sales successful!'
                ]);
            });
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 400);
        }
    }

    public function salesHistory()
    {
        $storeId = User::userStoreId();
        if (Gate::allows('Accountant')) {
            $params['items'] = Sale::join('sales_batches as sl', 'sl.id', '=', 'sales.sales_batch_id')
                ->where('is_paid', true)
                ->select('sales.*')->latest()->get();
        } else {
            $params['items'] = Sale::join('sales_batches as sl', 'sl.id', '=', 'sales.sales_batch_id')
                ->where('store_id', $storeId)->where('is_paid', true)
                ->select('sales.*')->latest()->get();
        }
        $params['is_post_back'] = false;
        return view('sales::sales.sales_history', $params);
    }

    public function salesHistoryFilter(Request $request)
    {
        $storeId = User::userStoreId();
        $data = $request->all();
        $start_date = Carbon::parse($data['start_date'])->startOfDay();
        $end_date = Carbon::parse($data['end_date'])->endOfDay();
        if (Gate::allows('Accountant')) {
            $params['items'] = Sale::join('sales_batches as sl', 'sl.id', '=', 'sales.sales_batch_id')
                ->where('is_paid', true)
                ->whereBetween('sales.created_at', [$start_date, $end_date])
                ->select('sales.*')->latest()->get();

            $params['total_price'] = Sale::join('sales_batches as sl', 'sl.id', '=', 'sales.sales_batch_id')
                ->where('is_paid', true)
                ->whereBetween('sales.created_at', [$start_date, $end_date])
                ->sum('sales.total_price');

        } else {
            $params['items'] = Sale::join('sales_batches as sl', 'sl.id', '=', 'sales.sales_batch_id')
                ->where('store_id', $storeId)
                ->where('is_paid', true)
                ->whereBetween('sales.created_at', [$start_date, $end_date])
                ->select('sales.*')->latest()->get();

            $params['total_price'] = Sale::join('sales_batches as sl', 'sl.id', '=', 'sales.sales_batch_id')
                ->where('store_id', $storeId)
                ->where('is_paid', true)
                ->whereBetween('sales.created_at', [$start_date, $end_date])
                ->sum('sales.total_price');
        }
        $prefix = "Sales Report From {$data['start_date']} To {$data['end_date']}";
        $params['is_post_back'] = true;
        session(['sales_data' => $params['items']]);
        session(['total_sales' => $params['total_price']]);
        session(['header_prefix' => $prefix]);
        return view('sales::sales.sales_history', $params);
    }

    public function downloadExcel()
    {
        return Excel::download(new ExpSalesReport(), 'sales_report.xlsx');
    }
}

<?php

namespace Modules\Sales\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Sales\Commands\Bills\BillPrint;

class BillPrintController extends Controller
{
    protected $billPrinter;

    public function __construct(BillPrint $billPrinter)
    {
        $this->billPrinter = $billPrinter;
    }

    public function print(Request $request)
    {
        // Sample data matching your receipt
        $billData = [
            'hotel_name' => 'Soweto Village Hotel',
            'receipt_no' => 'ACC-SJNW-2025-06030',
            'date' => '04-12-2025',
            'customer' => 'Walk-In Customer',
            'items' => [
                [
                    'code' => '520',
                    'name' => 'tende juice',
                    'quantity' => 1.0,
                    'unit_price' => 6000.00,
                    'total' => 6000.00
                ],
                [
                    'code' => '21121',
                    'name' => 'MANGO JUICE',
                    'quantity' => 5.0,
                    'unit_price' => 5000.00,
                    'total' => 25000.00
                ],
                [
                    'code' => '8',
                    'name' => 'black coffee',
                    'quantity' => 1.0,
                    'unit_price' => 5000.00,
                    'total' => 5000.00
                ],
                [
                    'code' => '2562',
                    'name' => 'tropical juice',
                    'quantity' => 3.0,
                    'unit_price' => 6000.00,
                    'total' => 18000.00
                ]
            ],
            'total' => 54000.00,
            'grand_total' => 54000.00,
            'rounded_total' => 54000.00,
            'paid_amount' => 54000.00,
            'total_qty' => 10
        ];

        try {
            $this->billPrinter->printBill($billData);

            return response()->json([
                'success' => true,
                'message' => 'Bill printed successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to print bill: ' . $e->getMessage()
            ], 500);
        }
    }
}

//
//namespace App\Http\Controllers;
//
//use App\Services\ReceiptPrinter;
//use Illuminate\Http\Request;
//
//class ReceiptController extends Controller
//{
//
//}

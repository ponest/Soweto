<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Soweto Village Hotel - Receipt</title>
    <style>
        /* Thermal printer optimized for 80mm x 297mm paper */
        @page {
            margin: 0;
            padding: 0;
            size: 80mm 297mm;
        }

        body {
            font-family: 'Courier New', monospace;
            font-size: 16px; /* Increased font size for better readability */
            line-height: 1.2;
            width: 76mm; /* 4mm margins on each side */
            margin: 2mm auto;
            padding: 0;
            background-color: white;
            /*max-height: 293mm; !* Fit within paper length *!*/
            /*max-height: 193mm;*/ /* Fit within paper length */
        }

        /* For thermal printers - minimal styling */
        * {
            box-sizing: border-box;
        }

        .receipt {
            width: 100%;
        }

        .header {
            text-align: center;
            margin-bottom: 8px;
            padding-bottom: 8px;
            border-bottom: 2px solid #000;
        }

        .hotel-name {
            font-size: 20px;
            font-weight: bold;
            margin: 5px 0;
            letter-spacing: 0.5px;
        }

        .invoice-title {
            font-size: 18px;
            font-weight: bold;
            margin: 5px 0;
        }

        .details {
            margin-bottom: 15px;
            font-size: 14px;
        }

        .details strong {
            font-size: 14px;
        }

        /* Items Table - Simple and clear */
        .items-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 12px;
        }

        .items-table th {
            text-align: left;
            padding: 6px 2px;
            border-bottom: 2px solid #000;
            font-size: 14px;
        }

        .items-table td {
            padding: 5px 2px;
            border-bottom: 1px dashed #333;
            font-size: 14px;
            vertical-align: top;
        }

        .col-item {
            width: 40%;
            text-align: left;
        }

        .col-qty {
            width: 20%;
            text-align: right;
        }

        .col-price {
            width: 40%;
            text-align: right;
        }

        /* Totals Section */
        .totals-section {
            margin-top: 15px;
            padding-top: 10px;
            border-top: 2px solid #000;
        }

        .total-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 6px;
            padding-bottom: 4px;
            border-bottom: 1px dotted #999;
            font-size: 15px;
        }

        /* Summary Box */

        /* Footer */
        .footer {
            text-align: center;
            margin-top: 20px;
            padding-top: 15px;
            border-top: 2px solid #000;
            font-size: 14px;
            line-height: 1.3;
        }

        .thank-you {
            font-size: 16px;
            font-weight: bold;
            margin: 10px 0;
        }

        /* Divider lines */
        .divider {
            text-align: center;
            margin: 8px 0;
            letter-spacing: 5px;
        }

        /* Print-specific styles */
        @media print {
            body {
                margin: 0;
                padding: 0;
                width: 80mm;
                max-height: 297mm;
            }

            .no-print {
                display: none;
            }

            /* Ensure everything prints in black */
            * {
                color: black !important;
            }

            /* Thermal printers work best with simple borders */
            .summary-box {
                border: 2px solid #000;
                background-color: transparent !important;
            }
        }
    </style>
</head>
<body>
<div class="receipt">
    <!-- Header -->
    <div class="header">
        <div class="hotel-name">SOWETO VILLAGE HOTEL</div>
        <div class="invoice-title">INVOICE</div>
    </div>

    <!-- Invoice Details -->
    <div class="details">
        <div><strong>Bill Ref:</strong> {{$bill->reference_no}}</div>
        <div><strong>Date:</strong> {{date('d M Y')}}</div>
        <div><strong>Time:</strong> {{ date('H:i') }}</div>
        <div><strong>Customer:</strong> Walk-In Customer</div>
        <div><strong>Waiters:</strong> {{$waiters}}</div>
    </div>

    <div class="divider">----------------------------------------</div>

    <!-- Items Table -->
    <table class="items-table">
        <thead>
        <tr>
            <th class="col-item">ITEM</th>
            <th class="col-qty">QTY</th>
            <th class="col-price">AMOUNT (TZS)</th>
        </tr>
        </thead>
        <tbody>
        @foreach($bill_items as $bill_item)
            <tr>
                <td class="col-item">{{$bill_item->item_name}}</td>
                <td class="col-qty">{{$bill_item->quantity}}</td>
                <td class="col-price">{{number_format($bill_item->total_price)}}</td>
            </tr>
        @endforeach
        </tbody>
        <tfoot>
        <tr style="font-weight: bold">
            <td class="col-item" colspan="2">Total</td>
            <td class="col-price">{{number_format($bill_sum)}}</td>
        </tr>
        </tfoot>
    </table>

    <div class="divider">----------------------------------------</div>

    <!-- Totals -->
    <div class="totals-section">
        <div class="total-row">
            <span>TOTAL:</span>
            <span>{{number_format($bill_sum)}} TZS</span>
        </div>
    </div>

    <div class="divider">========================================</div>

    <!-- Footer -->
    <div class="footer">
        <div class="thank-you">Thank you for your business!</div>
        <div>Please visit us again soon</div>
    </div>
</div>
</body>
</html>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            color: #333;
        }
        .invoice-container {
            max-width: 800px;
            margin: 0 auto;
            border: 1px solid #ddd;
            padding: 20px;
        }
        .header {
            position: relative;
            text-align: center;
            margin-bottom: 20px;
        }
        .hotel-name {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 5px;
        }
        .hotel-details {
            font-size: 14px;
            margin-bottom: 10px;
        }
        .tin {
            font-weight: bold;
        }
        .logo-container {
            position: absolute;
            right: 0;
            top: 0;
        }
        .logo-placeholder {
            width: 100px;
            height: 100px;
            background-color: #f5f5f5;
            border: 1px dashed #ccc;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #777;
            font-size: 12px;
        }
        .customer-details {
            margin-bottom: 20px;
            border: 1px solid #ddd;
            padding: 10px;
        }
        .customer-details h4 {
            margin-top: 0;
            border-bottom: 1px solid #ddd;
            padding-bottom: 5px;
        }
        .customer-info {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 10px;
        }
        .event-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        .event-table th, .event-table td {
            border: 1px solid #ddd;
            padding: 5px;
            text-align: left;
        }
        .event-table th {
            background-color: #f5f5f5;
        }
        .quality-guaranteed {
            text-align: center;
            font-weight: bold;
            margin: 20px 0;
        }
        .payment-methods {
            margin-bottom: 20px;
        }
        .payment-methods h4 {
            margin-top: 0;
            border-bottom: 1px solid #ddd;
            padding-bottom: 5px;
        }
        .payment-table {
            width: 100%;
            border-collapse: collapse;
        }
        .payment-table th, .payment-table td {
            border: 1px solid #ddd;
            padding: 5px;
            text-align: left;
        }
        .payment-table th {
            background-color: #f5f5f5;
        }
        .prepared-by {
            margin-top: 30px;
        }
        .prepared-by h4 {
            margin-top: 0;
            border-bottom: 1px solid #ddd;
            padding-bottom: 5px;
        }
    </style>
</head>

<body>
<div class="invoice-container">
    <div class="header">

        <div class="logo-container">
            <img src="{{ public_path('soweto_logo.png') }}" alt="Soweto Village Hotel Logo" style="max-width: 100px; max-height: 100px;">
        </div>

        <div class="hotel-name">TAX INVOICE</div>
        <div class="hotel-details">
            <div>SOWETO VILLAGE HOTEL</div>
            <div>P.O.BOX 1430</div>
            <div>MOBILE: 0719393832</div>
            <div>MOROGORO - TANZANIA</div>
            <div class="tin">TIN 110 949 839</div>
        </div>
    </div>

    <div class="customer-details">
        <h4>CUSTOMER DETAILS</h4>
        <div class="customer-info">
            <div><strong>Name:</strong> {{ $client->full_name ?? '' }}</div>
            <div><strong>Phone Number:</strong> {{ $client->phone_number }}</div>
            <div><strong>Email :</strong> {{ $client->email ?? '' }}</div>
        </div>
    </div>

    <div class="event-section">
        <h4>EVENT</h4>
        <table class="event-table">
            <thead>
            <tr>
                <th>DATE</th>
                <th>ITEM</th>
                <th>QUANTITY</th>
                <th>UNIT PRICE</th>
                <th>TOTAL PRICE</th>
            </tr>
            </thead>
            <tbody>
            @if(isset($bill_items) && count($bill_items) > 0)
                @foreach($bill_items as $item)
                    <tr>
                        <td>{{ date('d M Y',strtotime($item->created_at)) ?? '' }}</td>
                        <td>{{ $item->item_name ?? '' }}</td>
                        <td style="text-align: right">{{ number_format($item->quantity) ?? '' }}</td>
                        <td style="text-align: right">{{ number_format($item->unit_price) ?? '' }}</td>
                        <td style="text-align: right">{{ number_format($item->total_price) ?? '' }}</td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="6" style="text-align: center;">No items added</td>
                </tr>
            @endif
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="4">Total</th>
                    <th style="text-align: right">{{number_format($total_price)}}</th>
                </tr>
            </tfoot>
        </table>
    </div>

    <div class="quality-guaranteed">
        QUALITY GUARANTEED
    </div>

    <div class="payment-methods">
        <h4>METHODS OF PAYMENT</h4>
        <table class="payment-table">
            <thead>
            <tr>
                <th>ACCOUNT NO</th>
                <th>BANK NAME</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>0150736418700</td>
                <td>CRDB BANK - Soweto Village Hotel</td>
            </tr>
            <tr>
                <td>22290572</td>
                <td>LIPA NO TIGO - Soweto Village Hotel</td>
            </tr>
            <tr>
                <td>24510033790</td>
                <td>NMB - Soweto Village Hotel</td>
            </tr>
            </tbody>
        </table>
    </div>

    <div class="payment-methods">
        <h4>PREPARED BY</h4>
        <table class="payment-table">
            <thead>
            <tr>
                <th>NAME</th>
                <th>SIGNATURE</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>{{auth()->user()->full_name}}</td>
                <td></td>
            </tr>
            </tbody>
        </table>
    </div>

</div>
</body>
</html>

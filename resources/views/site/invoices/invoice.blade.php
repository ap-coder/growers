<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Invoice #{{ $order->number }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 14px;
            line-height: 1.6;
            color: #333;
        }
        .header {
            margin-bottom: 30px;
            border-bottom: 2px solid #4CAF50;
            padding-bottom: 20px;
        }
        .logo {
            max-width: 150px;
            margin-bottom: 10px;
        }
        .company-info {
            margin-bottom: 20px;
        }
        .invoice-title {
            font-size: 28px;
            font-weight: bold;
            color: #4CAF50;
            margin-bottom: 10px;
        }
        .invoice-details {
            margin-bottom: 30px;
        }
        .invoice-details table {
            width: 100%;
        }
        .invoice-details td {
            padding: 5px 0;
        }
        .invoice-details .label {
            font-weight: bold;
            width: 150px;
        }
        .section-title {
            font-size: 18px;
            font-weight: bold;
            margin-top: 30px;
            margin-bottom: 15px;
            color: #4CAF50;
            border-bottom: 1px solid #ddd;
            padding-bottom: 5px;
        }
        .items-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        .items-table th {
            background-color: #4CAF50;
            color: white;
            padding: 10px;
            text-align: left;
            font-weight: bold;
        }
        .items-table td {
            padding: 8px 10px;
            border-bottom: 1px solid #ddd;
        }
        .items-table tr:last-child td {
            border-bottom: 2px solid #4CAF50;
        }
        .text-right {
            text-align: right;
        }
        .text-center {
            text-align: center;
        }
        .totals {
            margin-top: 20px;
            float: right;
            width: 300px;
        }
        .totals table {
            width: 100%;
        }
        .totals td {
            padding: 5px 10px;
        }
        .totals .total-row {
            font-weight: bold;
            font-size: 16px;
            border-top: 2px solid #333;
        }
        .footer {
            margin-top: 50px;
            padding-top: 20px;
            border-top: 1px solid #ddd;
            text-align: center;
            font-size: 12px;
            color: #666;
        }
        .clearfix::after {
            content: "";
            display: table;
            clear: both;
        }
    </style>
</head>
<body>
    <div class="header">
        <div class="company-info">
            <h1 style="margin: 0; color: #4CAF50;">Pacific Plant Growers</h1>
            <p style="margin: 5px 0;">
                Your Address Here<br>
                Phone: (555) 123-4567<br>
                Email: info@ppgrowers.com
            </p>
        </div>
        <div class="invoice-title">INVOICE</div>
    </div>

    <div class="invoice-details">
        <table>
            <tr>
                <td class="label">Invoice Number:</td>
                <td>#{{ $order->number }}</td>
                <td class="label">Invoice Date:</td>
                <td>{{ $order->created_at->format('F d, Y') }}</td>
            </tr>
            <tr>
                <td class="label">Order Status:</td>
                <td>{{ ucfirst($order->status) }}</td>
                @if($order->estimated_delivery)
                <td class="label">Estimated Delivery:</td>
                <td>{{ \Carbon\Carbon::parse($order->estimated_delivery)->format('F d, Y') }}</td>
                @endif
            </tr>
        </table>
    </div>

    <div class="section-title">Bill To</div>
    <div style="margin-bottom: 30px;">
        <strong>{{ $order->client->name ?? 'N/A' }}</strong><br>
        @if($order->delivery_details)
            {{ $order->delivery_details }}
        @endif
        @if($order->ordered_by_name)
            <br>Attention: {{ $order->ordered_by_name }}
        @endif
        @if($order->ordered_by_phone)
            <br>Phone: {{ $order->ordered_by_phone }}
        @endif
    </div>

    <div class="section-title">Order Items</div>
    <table class="items-table">
        <thead>
            <tr>
                <th>Product</th>
                <th>SKU</th>
                <th class="text-center">Quantity</th>
                <th class="text-right">Unit Price</th>
                <th class="text-right">Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach($order->orderItems as $item)
            <tr>
                <td>{{ $item->product->name ?? 'N/A' }}</td>
                <td>{{ $item->sku ?? '-' }}</td>
                <td class="text-center">{{ $item->quantity }}</td>
                <td class="text-right">${{ number_format($item->price, 2) }}</td>
                <td class="text-right">${{ number_format($item->total_price, 2) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="clearfix">
        <div class="totals">
            <table>
                <tr>
                    <td>Subtotal:</td>
                    <td class="text-right">${{ number_format($order->order_total ?? 0, 2) }}</td>
                </tr>
                @if($order->shipping_cost)
                <tr>
                    <td>Shipping:</td>
                    <td class="text-right">${{ number_format($order->shipping_cost, 2) }}</td>
                </tr>
                @endif
                <tr class="total-row">
                    <td>Total:</td>
                    <td class="text-right">${{ number_format($order->total_price ?? 0, 2) }}</td>
                </tr>
            </table>
        </div>
    </div>

    @if($order->special_request)
    <div style="clear: both; margin-top: 30px;">
        <div class="section-title">Special Instructions</div>
        <p>{{ $order->special_request }}</p>
    </div>
    @endif

    <div class="footer">
        <p>Thank you for your business!</p>
        <p>If you have any questions about this invoice, please contact us.</p>
    </div>
</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice - Order #{{ $order->number }}</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            line-height: 1.4;
            padding: 20px;
        }
        .header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 30px;
            border-bottom: 3px solid #000;
            padding-bottom: 15px;
        }
        .company-info h1 {
            font-size: 28px;
            margin-bottom: 5px;
            color: #333;
        }
        .company-info p {
            font-size: 11px;
            color: #666;
            line-height: 1.5;
        }
        .invoice-info {
            text-align: right;
        }
        .invoice-info h2 {
            font-size: 32px;
            color: #333;
            margin-bottom: 10px;
        }
        .invoice-info p {
            font-size: 11px;
            margin-bottom: 3px;
        }
        .addresses {
            display: flex;
            justify-content: space-between;
            margin-bottom: 30px;
        }
        .address-section {
            width: 48%;
        }
        .address-section h3 {
            font-size: 14px;
            margin-bottom: 10px;
            color: #333;
            border-bottom: 2px solid #ddd;
            padding-bottom: 5px;
        }
        .address-section p {
            margin-bottom: 3px;
        }
        .items-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        .items-table thead {
            background-color: #333;
            color: #fff;
        }
        .items-table th {
            padding: 10px;
            text-align: left;
            font-weight: bold;
        }
        .items-table td {
            padding: 10px;
            border-bottom: 1px solid #ddd;
        }
        .items-table tbody tr:hover {
            background-color: #f9f9f9;
        }
        .items-table td:first-child {
            width: 60px;
            text-align: center;
        }
        .items-table td:nth-child(2) {
            width: 100px;
        }
        .items-table td:nth-child(4),
        .items-table td:nth-child(5) {
            text-align: right;
            width: 100px;
        }
        .totals {
            margin-left: auto;
            width: 300px;
            margin-top: 20px;
        }
        .totals-row {
            display: flex;
            justify-content: space-between;
            padding: 8px 0;
            border-bottom: 1px solid #ddd;
        }
        .totals-row.subtotal {
            font-size: 14px;
        }
        .totals-row.total {
            font-size: 18px;
            font-weight: bold;
            border-top: 2px solid #333;
            border-bottom: 3px double #333;
            margin-top: 5px;
            padding-top: 10px;
        }
        .notes-section {
            margin-top: 30px;
            padding: 15px;
            background-color: #f9f9f9;
            border-left: 4px solid #333;
        }
        .notes-section h3 {
            font-size: 14px;
            margin-bottom: 10px;
            color: #333;
        }
        .footer {
            margin-top: 50px;
            padding-top: 20px;
            border-top: 1px solid #ddd;
            text-align: center;
            font-size: 11px;
            color: #666;
        }
        .payment-terms {
            margin-top: 20px;
            padding: 10px;
            background-color: #fff3cd;
            border: 1px solid #ffc107;
            font-size: 11px;
        }
        @media print {
            body {
                padding: 0;
            }
            @page {
                size: letter;
                margin: 0.5in;
            }
            .items-table tbody tr:hover {
                background-color: transparent;
            }
        }
    </style>
</head>
<body onload="window.print()">
    <div class="header">
        <div class="company-info">
            @php
                $companyName = config('settings.company_name', 'Pacific Plant Growers');
                $companyAddress = config('settings.footer_address', '');
                $companyPhone = config('settings.footer_phone', '');
                $companyEmail = config('settings.footer_email', '');
            @endphp
            <h1>{{ $companyName }}</h1>
            @if($companyAddress)
                <p>{{ $companyAddress }}</p>
            @endif
            @if($companyPhone)
                <p>Phone: {{ $companyPhone }}</p>
            @endif
            @if($companyEmail)
                <p>Email: {{ $companyEmail }}</p>
            @endif
        </div>
        <div class="invoice-info">
            <h2>INVOICE</h2>
            <p><strong>Invoice #:</strong> {{ $order->number }}</p>
            <p><strong>Date:</strong> {{ $order->created_at->format('F d, Y') }}</p>
            @if($order->delivery_date)
                <p><strong>Delivery Date:</strong> {{ \Carbon\Carbon::parse($order->delivery_date)->format('F d, Y') }}</p>
            @endif
            <p><strong>Status:</strong> {{ \App\Models\Order::STATUS_SELECT[$order->status] ?? $order->status }}</p>
        </div>
    </div>

    <div class="addresses">
        <div class="address-section">
            <h3>Bill To</h3>
            <p><strong>{{ $order->client->name ?? 'N/A' }}</strong></p>
            @if($order->client && $order->client->store_number)
                <p>Store #{{ $order->client->store_number }}</p>
            @endif
            @if($order->client && $order->client->address)
                <p>{{ $order->client->address }}</p>
            @endif
            @if($order->client && $order->client->contact_name)
                <p>Attn: {{ $order->client->contact_name }}</p>
            @endif
            @if($order->client && $order->client->contact_phone)
                <p>Phone: {{ $order->client->contact_phone }}</p>
            @endif
            @if($order->client && $order->client->contact_email)
                <p>Email: {{ $order->client->contact_email }}</p>
            @endif
        </div>

        <div class="address-section">
            <h3>Ship To</h3>
            @if($order->delivery_details)
                <p>{{ $order->delivery_details }}</p>
            @else
                <p><strong>{{ $order->client->name ?? 'N/A' }}</strong></p>
                @if($order->client && $order->client->store_number)
                    <p>Store #{{ $order->client->store_number }}</p>
                @endif
            @endif
            @if($order->ordered_by_name)
                <p>Attn: {{ $order->ordered_by_name }}</p>
            @endif
            @if($order->ordered_by_phone)
                <p>Phone: {{ $order->ordered_by_phone }}</p>
            @endif
        </div>
    </div>

    <table class="items-table">
        <thead>
            <tr>
                <th>Qty</th>
                <th>SKU</th>
                <th>Description</th>
                <th>Unit Price</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach($order->orderItems as $item)
            <tr>
                <td style="text-align: center;"><strong>{{ $item->quantity }}</strong></td>
                <td>{{ $item->sku ?? '-' }}</td>
                <td>{{ $item->product->name ?? 'Unknown Product' }}</td>
                <td style="text-align: right;">${{ number_format($item->price, 2) }}</td>
                <td style="text-align: right;">${{ number_format($item->total_price, 2) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="totals">
        <div class="totals-row subtotal">
            <span>Subtotal:</span>
            <span>${{ number_format($order->order_total ?? 0, 2) }}</span>
        </div>
        @if($order->shipping_cost && $order->shipping_cost > 0)
        <div class="totals-row">
            <span>Shipping:</span>
            <span>${{ number_format($order->shipping_cost, 2) }}</span>
        </div>
        @endif
        <div class="totals-row total">
            <span>Total:</span>
            <span>${{ number_format($order->total_price ?? 0, 2) }}</span>
        </div>
    </div>

    @if($order->special_request)
    <div class="notes-section">
        <h3>Notes</h3>
        <p><strong>Special Instructions:</strong> {{ $order->special_request }}</p>
    </div>
    @endif

    <div class="payment-terms">
        <strong>Payment Terms:</strong> Net 30 days from invoice date. Please include invoice number with payment.
    </div>

    <div class="footer">
        <p>Thank you for your business!</p>
        <p style="margin-top: 5px;">If you have any questions about this invoice, please contact us at {{ $companyPhone ?? 'our office' }}</p>
    </div>
</body>
</html>

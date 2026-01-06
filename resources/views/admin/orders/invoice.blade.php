<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice #{{ $order->number }} - {{ $order->client->name ?? 'Invoice' }}</title>
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
        .invoice-header {
            display: flex;
            justify-content: space-between;
            margin-bottom: 30px;
            border-bottom: 2px solid #000;
            padding-bottom: 15px;
        }
        .company-info {
            flex: 1;
        }
        .company-name {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 5px;
        }
        .invoice-info {
            text-align: right;
        }
        .invoice-title {
            font-size: 28px;
            font-weight: bold;
            margin-bottom: 10px;
        }
        .invoice-details {
            margin-bottom: 30px;
            display: flex;
            justify-content: space-between;
        }
        .bill-to, .ship-to {
            flex: 1;
        }
        .section-title {
            font-weight: bold;
            font-size: 14px;
            margin-bottom: 5px;
            text-transform: uppercase;
        }
        .items-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        .items-table th {
            background: #f0f0f0;
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
            font-weight: bold;
        }
        .items-table td {
            border: 1px solid #ddd;
            padding: 8px;
        }
        .items-table td.text-right {
            text-align: right;
        }
        .items-table td.text-center {
            text-align: center;
        }
        .totals {
            margin-left: auto;
            width: 300px;
        }
        .totals-row {
            display: flex;
            justify-content: space-between;
            padding: 5px 0;
        }
        .totals-row.total {
            font-weight: bold;
            font-size: 16px;
            border-top: 2px solid #000;
            padding-top: 10px;
            margin-top: 10px;
        }
        .notes {
            margin-top: 30px;
            padding: 15px;
            background: #f9f9f9;
            border: 1px solid #ddd;
        }
        .notes-title {
            font-weight: bold;
            margin-bottom: 5px;
        }
        @media print {
            body {
                padding: 0;
            }
            @page {
                size: letter;
                margin: 0.5in;
            }
        }
    </style>
</head>
<body>
    <div class="invoice-header">
        <div class="company-info">
            <div class="company-name">Pacific Plant Growers</div>
            <div>123 Garden Way</div>
            <div>Plant City, CA 12345</div>
            <div>Phone: (555) 123-4567</div>
        </div>
        <div class="invoice-info">
            <div class="invoice-title">INVOICE</div>
            <div><strong>Invoice #:</strong> {{ $order->number }}</div>
            <div><strong>Date:</strong> {{ $order->created_at->format('m/d/Y') }}</div>
            @if($order->delivery_date)
            <div><strong>Delivery Date:</strong> {{ \Carbon\Carbon::parse($order->delivery_date)->format('m/d/Y') }}</div>
            @endif
        </div>
    </div>

    <div class="invoice-details">
        <div class="bill-to">
            <div class="section-title">Bill To:</div>
            <div><strong>{{ $order->client->name ?? 'N/A' }}</strong></div>
            @if($order->client && $order->client->store_number)
            <div>Store #{{ $order->client->store_number }}</div>
            @endif
            @if($order->client && $order->client->address)
            <div>{{ $order->client->address }}</div>
            @endif
            @if($order->client && $order->client->contact_name)
            <div>Attn: {{ $order->client->contact_name }}</div>
            @endif
            @if($order->client && $order->client->contact_phone)
            <div>Phone: {{ $order->client->contact_phone }}</div>
            @endif
        </div>
        <div class="ship-to">
            <div class="section-title">Order Details:</div>
            @if($order->ordered_by_name)
            <div><strong>Ordered By:</strong> {{ $order->ordered_by_name }}</div>
            @endif
            @if($order->ordered_by_phone)
            <div><strong>Phone:</strong> {{ $order->ordered_by_phone }}</div>
            @endif
            @if($order->store_location_request)
            <div><strong>Store Location:</strong> {{ $order->store_location_request }}</div>
            @endif
        </div>
    </div>

    <table class="items-table">
        <thead>
            <tr>
                <th style="width: 10%;">Qty</th>
                <th style="width: 15%;">SKU/UPC</th>
                <th style="width: 45%;">Product Description</th>
                <th style="width: 15%;" class="text-right">Unit Price</th>
                <th style="width: 15%;" class="text-right">Total</th>
            </tr>
        </thead>
        <tbody>
            @php
                $subtotal = 0;
            @endphp
            @foreach($order->orderItems as $item)
                @php
                    $lineTotal = $item->quantity * $item->price;
                    $subtotal += $lineTotal;
                    
                    // Check if this is a variation (ProductVariation model)
                    $isVariation = $item->product && get_class($item->product) === 'App\Models\ProductVariation';
                    $productName = $item->product->name ?? 'Unknown Product';
                    
                    // If it's a variation, prepend the parent product name
                    if ($isVariation && $item->product->product) {
                        $productName = $item->product->product->name . ' - ' . $item->product->name;
                    }
                @endphp
                <tr>
                    <td class="text-center">{{ $item->quantity }}</td>
                    <td>{{ $item->product->sku ?? $item->product->upc_code ?? '-' }}</td>
                    <td>{{ $productName }}</td>
                    <td class="text-right">${{ number_format($item->price, 2) }}</td>
                    <td class="text-right">${{ number_format($lineTotal, 2) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="totals">
        <div class="totals-row">
            <span>Subtotal:</span>
            <span>${{ number_format($subtotal, 2) }}</span>
        </div>
        <div class="totals-row">
            <span>Tax:</span>
            <span>${{ number_format(0, 2) }}</span>
        </div>
        <div class="totals-row total">
            <span>Total:</span>
            <span>${{ number_format($subtotal, 2) }}</span>
        </div>
    </div>

    @if($order->special_request || $order->delivery_details)
    <div class="notes">
        @if($order->special_request)
        <div class="notes-title">Special Instructions:</div>
        <div>{{ $order->special_request }}</div>
        @endif
        @if($order->delivery_details)
        <div class="notes-title" style="margin-top: 10px;">Delivery Details:</div>
        <div>{{ $order->delivery_details }}</div>
        @endif
    </div>
    @endif

    <script>
        window.onload = function() {
            window.print();
        };
    </script>
</body>
</html>

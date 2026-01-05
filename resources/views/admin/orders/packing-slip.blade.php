<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Packing Slip #{{ $order->number }} - {{ $order->client->name ?? 'Order' }}</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: Arial, sans-serif;
            font-size: 11px;
            line-height: 1.3;
            padding: 10px;
            max-width: 100%;
            margin: 0 auto;
        }
        .container {
            display: flex;
            gap: 15px;
        }
        .left-side {
            width: 50%;
        }
        .right-side {
            width: 50%;
        }
        .header {
            font-size: 16px;
            font-weight: bold;
            margin-bottom: 5px;
        }
        .sub-header {
            font-size: 10px;
            margin-bottom: 10px;
        }
        .info-row {
            margin-bottom: 3px;
        }
        .info-label {
            font-weight: bold;
        }
        .category-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 8px;
            margin-top: 10px;
        }
        .category-box {
            border: 1px solid #000;
            padding: 5px;
            min-height: 60px;
        }
        .category-title {
            font-weight: bold;
            font-size: 10px;
            border-bottom: 1px solid #000;
            margin-bottom: 3px;
            padding-bottom: 2px;
        }
        .category-items {
            font-size: 9px;
        }
        .category-items li {
            list-style: none;
        }
        .special-box {
            border: 2px solid #000;
            padding: 5px;
            margin-top: 10px;
        }
        .special-title {
            font-weight: bold;
            text-decoration: underline;
            margin-bottom: 3px;
        }
        .upc-section {
            border: 1px solid #000;
        }
        .upc-header {
            background: #fff;
            color: #000;
            border: 2px solid #000;
            padding: 5px;
            font-weight: bold;
            font-size: 12px;
        }
        .upc-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 9px;
        }
        .upc-table th,
        .upc-table td {
            border-bottom: 1px solid #ddd;
            padding: 2px 4px;
            text-align: left;
        }
        .upc-table th {
            background: #f0f0f0;
            font-weight: bold;
        }
        .upc-table td:first-child {
            width: 30px;
            text-align: center;
        }
        .upc-table td:nth-child(2) {
            width: 50px;
        }
        @media print {
            body {
                padding: 0;
            }
            @page {
                size: letter landscape;
                margin: 0.5in;
            }
        }
    </style>
</head>
<body onload="window.print()">
    <div class="container">
        <div class="left-side">
            <div class="header">{{ $order->client->name ?? 'No Client' }} {{ $order->client->store_number ? '#' . $order->client->store_number : '' }}</div>
            <div class="sub-header">
                <div class="info-row"><span class="info-label">Date of Order:</span> {{ $order->created_at->format('m/d/Y') }}</div>
                <div class="info-row"><span class="info-label">Order Placed By:</span> {{ $order->created_by->name ?? 'N/A' }}</div>
                <div class="info-row"><span class="info-label">Phone:</span> {{ $order->created_by->phone ?? 'N/A' }}</div>
                <div class="info-row"><span class="info-label">Delivery Date:</span> {{ $order->delivery_date ? \Carbon\Carbon::parse($order->delivery_date)->format('l m/d/Y') : 'N/A' }}</div>
                @if($order->delivery_details)
                <div class="info-row"><span class="info-label">Delivery Details:</span> {{ $order->delivery_details }}</div>
                @endif
                @if($order->store_location_request)
                <div class="info-row"><span class="info-label">Store Location:</span> {{ $order->store_location_request }}</div>
                @endif
            </div>

            @php
                $itemsByCategory = $order->orderItems->groupBy(function($item) {
                    return $item->product->categories->first()->name ?? 'Uncategorized';
                });
                
                $categoryOrder = ['Baskets', 'Specialty', 'Tins', 'Bamboo', 'Ceramics', 'Foliage', 'Wood', 'Supplies', 'Novelty'];
                $sortedCategories = collect();
                
                foreach ($categoryOrder as $cat) {
                    if ($itemsByCategory->has($cat)) {
                        $sortedCategories[$cat] = $itemsByCategory[$cat];
                    }
                }
                foreach ($itemsByCategory as $cat => $items) {
                    if (!$sortedCategories->has($cat)) {
                        $sortedCategories[$cat] = $items;
                    }
                }
            @endphp

            <div class="category-grid">
                @foreach($sortedCategories as $category => $items)
                    <div class="category-box">
                        <div class="category-title">{{ strtoupper($category) }}</div>
                        <ul class="category-items">
                            @foreach($items as $item)
                                <li>{{ $item->quantity }} {{ $item->product->name ?? 'Unknown' }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endforeach
            </div>

            @if($order->delivery_details)
                <div class="special-box">
                    <div class="special-title">DELIVERY DETAILS</div>
                    <div>{{ $order->delivery_details }}</div>
                </div>
            @endif

            @if($order->special_request)
                <div class="special-box">
                    <div class="special-title">SPECIAL INSTRUCTIONS</div>
                    <div>{{ $order->special_request }}</div>
                </div>
            @endif

            @if($order->internal_notes)
                <div class="special-box" style="border-color: #666; background: #f9f9f9;">
                    <div class="special-title">INTERNAL NOTES (Admin Only)</div>
                    <div>{{ $order->internal_notes }}</div>
                </div>
            @endif
        </div>

        <div class="right-side">
            <div class="upc-section">
                <div class="upc-header">UPC CODES</div>
                <table class="upc-table">
                    <thead>
                        <tr>
                            <th>Qty</th>
                            <th>UPC</th>
                            <th>Product</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($order->orderItems->sortBy(function($item) {
                            return $item->product->qb_1 ?? 'zzz';
                        }) as $item)
                            <tr>
                                <td>{{ $item->quantity }}</td>
                                <td>{{ $item->product->qb_1 ?? '-' }}</td>
                                <td>{{ $item->product->name ?? 'Unknown' }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order #{{ $order->number }} - {{ $order->client->name ?? 'Order' }}</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: Arial, sans-serif;
            font-size: 14px;
            line-height: 1.3;
            padding: 15px;
        }
        .container {
            display: flex;
            gap: 20px;
        }
        .left-side {
            width: 50%;
        }
        .right-side {
            width: 50%;
        }
        .header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 10px;
        }
        .header-left h1 {
            font-size: 22px;
            font-weight: bold;
            margin-bottom: 5px;
        }
        .header-info {
            font-size: 13px;
            line-height: 1.4;
        }
        .header-right {
            text-align: right;
        }
        .client-logo {
            max-width: 120px;
            max-height: 80px;
        }
        .category-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 10px;
            margin-top: 10px;
        }
        .category-box {
            border: 1px solid #000;
            padding: 8px;
            min-height: 80px;
        }
        .category-title {
            font-weight: bold;
            font-size: 13px;
            border-bottom: 1px solid #000;
            margin-bottom: 5px;
            padding-bottom: 3px;
            text-transform: uppercase;
        }
        .category-items {
            font-size: 12px;
        }
        .category-items li {
            list-style: none;
            margin-bottom: 2px;
        }
        .special-box {
            border: 2px solid #000;
            padding: 8px;
            margin-top: 10px;
        }
        .special-title {
            font-weight: bold;
            text-decoration: underline;
            margin-bottom: 5px;
            text-transform: uppercase;
        }
        .upc-section {
            border: 1px solid #000;
        }
        .upc-header {
            background: #fff;
            color: #000;
            padding: 8px;
            font-weight: bold;
            font-size: 14px;
            text-transform: uppercase;
            border-bottom: 1px solid #000;
        }
        .upc-list {
            padding: 8px;
            font-size: 12px;
        }
        .upc-item {
            display: flex;
            gap: 10px;
            margin-bottom: 3px;
            line-height: 1.4;
        }
        .upc-qty {
            width: 30px;
            text-align: right;
            font-weight: bold;
        }
        .upc-code {
            width: 50px;
        }
        .upc-name {
            flex: 1;
        }
        @media print {
            body {
                padding: 0;
            }
            @page {
                size: landscape;
                margin: 0.4in;
            }
        }
    </style>
</head>
<body onload="window.print()">
    <div class="header">
        <div class="header-left">
            <h1>{{ $order->client->name ?? 'No Client' }} {{ $order->client->store_number ? '#' . $order->client->store_number : '' }}</h1>
            <div class="header-info">
                <div>Date of Order: {{ $order->created_at->format('m/d/Y') }}</div>
                <div>Order Placed By: {{ $order->ordered_by_name ?? auth()->user()->name ?? 'N/A' }}</div>
                @if($order->ordered_by_phone)
                <div>Phone: {{ $order->ordered_by_phone }}</div>
                @endif
                @if($order->delivery_date)
                <div>Delivery Date: {{ \Carbon\Carbon::parse($order->delivery_date)->format('l m/d/Y') }}</div>
                @endif
            </div>
        </div>
        <div class="header-right">
            @if($order->client && $order->client->logo)
                <img src="{{ $order->client->logo->url ?? '' }}" alt="{{ $order->client->name }}" class="client-logo">
            @endif
        </div>
    </div>

    <div class="container">
        <div class="left-side">
            @php
                $itemsByCategory = $order->orderItems->groupBy(function($item) {
                    return $item->product->categories->first()->name ?? 'Uncategorized';
                });
                
                $categoryOrder = ['Baskets', 'Specialty', 'Tins', 'Bamboo', 'Ceramics', 'Foliage', 'Wood', 'Supplies', 'Novelty'];
                $sortedCategories = collect();
                
                // Only show categories that have products in this order
                foreach ($categoryOrder as $cat) {
                    if ($itemsByCategory->has($cat)) {
                        $sortedCategories[$cat] = $itemsByCategory[$cat];
                    }
                }
                // Add any other categories not in the predefined list
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

            @if($order->special_request)
                <div class="special-box">
                    <div class="special-title">Special Instructions</div>
                    <div>{{ $order->special_request }}</div>
                </div>
            @endif
        </div>

        <div class="right-side">
            <div class="upc-section">
                <div class="upc-header">UPC Codes</div>
                <div class="upc-list">
                    @foreach($order->orderItems->sortBy(function($item) {
                        return $item->qb_1 ?? $item->gtin ?? 'zzz';
                    }) as $item)
                        <div class="upc-item">
                            <div class="upc-qty">{{ $item->quantity }}</div>
                            <div class="upc-code">{{ $item->qb_1 ?? '-' }}</div>
                            <div class="upc-name">{{ $item->product->name ?? 'Unknown' }}</div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</body>
</html>

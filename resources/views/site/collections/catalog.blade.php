<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $collection->name }} - Catalog | Pacific Plant Growers</title>
    <link href="https://fonts.googleapis.com/css2?family=Marcellus&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Marcellus', Georgia, serif;
            color: #333;
            background: #fff;
            line-height: 1.6;
        }
        
        .catalog-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }
        
        /* Header */
        .catalog-header {
            text-align: center;
            padding: 40px 20px;
            border-bottom: 3px solid #5a8f3e;
            margin-bottom: 40px;
        }
        
        .catalog-header .logo {
            max-width: 200px;
            margin-bottom: 20px;
        }
        
        .catalog-header h1 {
            font-size: 2.5rem;
            color: #5a8f3e;
            margin-bottom: 10px;
        }
        
        .catalog-header .description {
            font-size: 1.1rem;
            color: #666;
            max-width: 600px;
            margin: 0 auto;
        }
        
        .catalog-header .date {
            font-size: 0.9rem;
            color: #999;
            margin-top: 15px;
        }
        
        /* Products Grid */
        .products-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 30px;
            margin-bottom: 40px;
        }
        
        .product-card {
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            overflow: hidden;
            page-break-inside: avoid;
        }
        
        .product-card .image-container {
            width: 100%;
            height: 200px;
            overflow: hidden;
            background: #f5f5f5;
        }
        
        .product-card .image-container img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        
        .product-card .content {
            padding: 15px;
        }
        
        .product-card .category {
            font-size: 0.75rem;
            color: #5a8f3e;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 5px;
        }
        
        .product-card h3 {
            font-size: 1.1rem;
            color: #333;
            margin-bottom: 8px;
        }
        
        .product-card .description {
            font-size: 0.85rem;
            color: #666;
            margin-bottom: 10px;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
        
        .product-card .price {
            font-size: 1.2rem;
            font-weight: bold;
            color: #5a8f3e;
        }
        
        .product-card .sku {
            font-size: 0.75rem;
            color: #999;
        }
        
        /* Footer */
        .catalog-footer {
            text-align: center;
            padding: 30px 20px;
            border-top: 2px solid #e0e0e0;
            margin-top: 40px;
        }
        
        .catalog-footer .company-name {
            font-size: 1.5rem;
            color: #5a8f3e;
            margin-bottom: 10px;
        }
        
        .catalog-footer .contact-info {
            font-size: 0.9rem;
            color: #666;
        }
        
        .catalog-footer .contact-info p {
            margin: 5px 0;
        }
        
        /* Action Buttons - Hide on print */
        .action-buttons {
            position: fixed;
            top: 20px;
            right: 20px;
            display: flex;
            gap: 10px;
            z-index: 1000;
        }
        
        .action-buttons button {
            padding: 12px 24px;
            font-size: 1rem;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-family: inherit;
        }
        
        .btn-print {
            background: #5a8f3e;
            color: white;
        }
        
        .btn-print:hover {
            background: #4a7a32;
        }
        
        .btn-back {
            background: #666;
            color: white;
        }
        
        .btn-back:hover {
            background: #555;
        }
        
        /* Print Styles */
        @media print {
            .action-buttons {
                display: none !important;
            }
            
            body {
                print-color-adjust: exact;
                -webkit-print-color-adjust: exact;
            }
            
            .catalog-container {
                padding: 0;
            }
            
            .products-grid {
                grid-template-columns: repeat(3, 1fr);
                gap: 20px;
            }
            
            .product-card {
                break-inside: avoid;
            }
            
            .catalog-header {
                padding: 20px;
            }
            
            @page {
                margin: 0.5in;
                size: letter;
            }
        }
        
        /* Responsive */
        @media screen and (max-width: 992px) {
            .products-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }
        
        @media screen and (max-width: 576px) {
            .products-grid {
                grid-template-columns: 1fr;
            }
            
            .catalog-header h1 {
                font-size: 1.8rem;
            }
        }
    </style>
</head>
<body>
    <div class="action-buttons">
        <button class="btn-back" onclick="window.history.back()">← Back</button>
        <button class="btn-print" onclick="window.print()">🖨️ Print / Save PDF</button>
    </div>
    
    <div class="catalog-container">
        <header class="catalog-header">
            <img src="{{ asset('site/images/logo.svg') }}" alt="Pacific Plant Growers" class="logo">
            <h1>{{ $collection->name }}</h1>
            @if($collection->description)
            <p class="description">{{ $collection->description }}</p>
            @endif
            <p class="date">Catalog Date: {{ now()->format('F j, Y') }}</p>
        </header>
        
        <div class="products-grid">
            @foreach($products as $product)
            <div class="product-card">
                <div class="image-container">
                    @if($product->hasMedia('images'))
                        <img src="{{ $product->getFirstMediaUrl('images', 'large') }}" alt="{{ $product->name }}">
                    @else
                        <img src="{{ asset('site/images/shop/product/1.png') }}" alt="{{ $product->name }}">
                    @endif
                </div>
                <div class="content">
                    @if($product->categories->count() > 0)
                    <div class="category">{{ $product->categories->first()->name }}</div>
                    @endif
                    <h3>{{ $product->name }}</h3>
                    @if($product->description)
                    <p class="description">{{ Str::limit(strip_tags($product->description), 100) }}</p>
                    @endif
                    @if($product->sku)
                    <p class="sku">SKU: {{ $product->sku }}</p>
                    @endif
                    @auth
                    @php
                        $price = $product->getPriceForClient(auth()->user()->client_id ?? null);
                    @endphp
                    @if($price)
                    <p class="price">${{ number_format($price, 2) }}</p>
                    @endif
                    @endauth
                </div>
            </div>
            @endforeach
        </div>
        
        <footer class="catalog-footer">
            <div class="company-name">Pacific Plant Growers</div>
            <div class="contact-info">
                <p>For orders and inquiries, please contact us</p>
                <p>www.pacificplantgrowers.com</p>
            </div>
        </footer>
    </div>
</body>
</html>

@php
    $price = $product->getPriceForClient($clientId ?? null);
@endphp
<div class="col-lg-{{ $colSize ?? 3 }} col-md-4 col-sm-6 m-b30">
    <div class="dz-product-box style-2">
        <div class="dz-media">
            <a href="{{ route('site.shop.product', $product) }}">
                @if($product->photo)
                    <img src="{{ $product->photo->url }}" alt="{{ $product->name }}">
                @else
                    <img src="{{ asset('site/images/shop/product/1.png') }}" alt="{{ $product->name }}">
                @endif
            </a>
            <div class="dz-hover-content">
                <ul class="dz-info">
                    <li><a href="{{ route('site.shop.product', $product) }}" class="btn btn-secondary btn-sm">
                        <i class="fas fa-eye me-1"></i> View
                    </a></li>
                </ul>
            </div>
            @if($product->featured)
                <span class="badge badge-secondary product-tag">Featured</span>
            @endif
        </div>
        <div class="dz-content">
            <h5 class="title">
                <a href="{{ route('site.shop.product', $product) }}">{{ $product->name }}</a>
            </h5>
            @if($product->categories->count() > 0)
                <span class="product-category text-muted small">
                    {{ $product->categories->first()->name }}
                </span>
            @endif
            <span class="price">
                @if($price)
                    ${{ number_format($price, 2) }}
                @else
                    <span class="text-muted">Contact for pricing</span>
                @endif
            </span>
        </div>
    </div>
</div>

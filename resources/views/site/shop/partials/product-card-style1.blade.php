@php
    $price = $product->getPriceForClient($clientId ?? null);
@endphp
<div class="col-lg-4 col-md-6 col-sm-6 m-b30">
    <div class="dz-product-box style-1">
        <div class="dz-media">
            <a href="{{ route('site.shop.product', $product) }}">
                @if($product->photo)
                    <img src="{{ $product->photo->url }}" alt="{{ $product->name }}">
                @else
                    <img src="{{ asset('site/images/shop/product/1.png') }}" alt="{{ $product->name }}">
                @endif
            </a>
            @if($product->featured)
                <span class="badge badge-secondary product-tag">Featured</span>
            @endif
            <div class="dz-hover-content">
                <ul class="dz-info">
                    <li><a href="{{ route('site.shop.product', $product) }}" class="btn btn-secondary btn-icon">
                        <i class="fas fa-eye"></i>
                    </a></li>
                </ul>
            </div>
        </div>
        <div class="dz-content">
            @if($product->categories->count() > 0)
                <span class="product-category text-muted small d-block mb-1">
                    {{ $product->categories->first()->name }}
                </span>
            @endif
            <h5 class="title">
                <a href="{{ route('site.shop.product', $product) }}">{{ $product->name }}</a>
            </h5>
            <div class="d-flex justify-content-between align-items-center">
                <span class="price">
                    @if($price)
                        ${{ number_format($price, 2) }}
                    @else
                        <span class="text-muted small">Contact for pricing</span>
                    @endif
                </span>
                <a href="{{ route('site.shop.product', $product) }}" class="btn btn-outline-primary btn-sm">View</a>
            </div>
        </div>
    </div>
</div>

@php
    $price = $product->getPriceForClient($clientId ?? null);
@endphp
<div class="col-6 col-xl-{{ $colSize ?? 3 }} col-lg-4 col-md-6 col-sm-6 m-b30">
    <div class="shop-card">
        <div class="dz-media">
            <a href="{{ route('site.shop.product', $product) }}">
                @if($product->photo)
                    <img src="{{ $product->photo->url }}" alt="{{ $product->name }}">
                @else
                    <img src="{{ asset('site/images/shop/product/1.png') }}" alt="{{ $product->name }}">
                @endif
            </a>
            @if($product->featured)
                <div class="product-tag">
                    <span class="badge badge-secondary">Featured</span>
                </div>
            @endif
            <div class="shop-meta">
                <div class="btn btn-primary meta-icon dz-wishicon">
                    <i class="icon feather icon-heart dz-heart"></i>
                    <i class="icon feather icon-heart-on dz-heart-fill"></i>
                </div>
                <a href="{{ route('site.shop.product', $product) }}" class="btn btn-primary meta-icon">
                    <i class="flaticon flaticon-eye"></i>
                </a>
                <div class="btn btn-primary meta-icon dz-carticon">
                    <i class="flaticon flaticon-basket"></i>
                    <i class="flaticon flaticon-basket-on dz-heart-fill"></i>
                </div>
            </div>
        </div>
        <div class="dz-content">
            <h2 class="title"><a href="{{ route('site.shop.product', $product) }}">{{ $product->name }}</a></h2>
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

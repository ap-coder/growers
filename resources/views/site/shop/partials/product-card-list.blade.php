@php
    $price = $product->getPriceForClient($clientId ?? null);
@endphp
<div class="col-12 m-b30">
    <div class="dz-product-box style-2 dz-product-box-list">
        <div class="row align-items-center">
            <div class="col-md-3">
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
                </div>
            </div>
            <div class="col-md-6">
                <div class="dz-content">
                    <h5 class="title">
                        <a href="{{ route('site.shop.product', $product) }}">{{ $product->name }}</a>
                    </h5>
                    @if($product->categories->count() > 0)
                        <span class="product-category text-muted small">
                            {{ $product->categories->pluck('name')->implode(', ') }}
                        </span>
                    @endif
                    @if($product->description)
                        <p class="mt-2 text-muted">{{ Str::limit($product->description, 150) }}</p>
                    @endif
                </div>
            </div>
            <div class="col-md-3 text-md-end">
                <span class="price d-block mb-3">
                    @if($price)
                        ${{ number_format($price, 2) }}
                    @else
                        <span class="text-muted">Contact for pricing</span>
                    @endif
                </span>
                <a href="{{ route('site.shop.product', $product) }}" class="btn btn-secondary btn-sm">
                    <i class="fas fa-eye me-1"></i> View Details
                </a>
            </div>
        </div>
    </div>
</div>

@extends('site.layouts.app')

@section('title', $product->name . ' - Pacific Plant Growers')

@php
    $price = $product->getPriceForClient($clientId ?? null);
@endphp

@section('banner')
<div class="dz-bnr-inr" style="background-image:url({{ asset('site/images/background/bg1.jpg') }});">
    <div class="container">
        <div class="dz-bnr-inr-entry">
            <nav aria-label="breadcrumb" class="breadcrumb-row">
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('frontend.home') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('site.shop.index') }}">Shop</a></li>
                    <li class="breadcrumb-item active">{{ $product->name }}</li>
                </ul>
            </nav>
        </div>
    </div>
</div>
@endsection

@section('content')
<section class="content-inner">
    <div class="container">
        <div class="row">
            <div class="col-lg-1 col-md-2 m-b30 order-lg-1 order-2">
                <div class="thumb-gallery-vertical">
                    @if($product->photo)
                        <div class="thumb-item active" onclick="changeMainImage('{{ $product->photo->url }}', this)">
                            <img src="{{ $product->photo->thumbnail }}" alt="{{ $product->name }}">
                        </div>
                    @endif
                    @if($product->additional_photos)
                        @foreach($product->additional_photos as $photo)
                            <div class="thumb-item" onclick="changeMainImage('{{ $photo->url }}', this)">
                                <img src="{{ $photo->thumbnail }}" alt="{{ $product->name }}">
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
            <div class="col-lg-5 col-md-10 m-b30 order-lg-2 order-1">
                <div class="dz-product-detail sticky-top">
                    <div class="dz-media">
                        @if($product->photo)
                            <img src="{{ $product->photo->url }}" alt="{{ $product->name }}" id="main-product-image">
                        @else
                            <img src="{{ asset('site/images/shop/product/1.png') }}" alt="{{ $product->name }}" id="main-product-image">
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-lg-6 m-b30 order-lg-3 order-3">
                <div class="dz-product-detail-content">
                    @if($product->categories->count() > 0)
                        <div class="product-category mb-2">
                            @foreach($product->categories as $category)
                                <a href="{{ route('site.shop.index', ['category' => $category->id]) }}" class="badge bg-light text-dark me-1">{{ $category->name }}</a>
                            @endforeach
                        </div>
                    @endif
                    
                    <h2 class="title mb-3">{{ $product->name }}</h2>
                    
                    @if($product->sku)
                        <p class="text-muted mb-2"><small>SKU: {{ $product->sku }}</small></p>
                    @endif
                    
                    <div class="price-area mb-4">
                        <span class="price h3 text-primary">
                            @if($price)
                                ${{ number_format($price, 2) }}
                            @else
                                <span class="text-muted">Contact for pricing</span>
                            @endif
                        </span>
                    </div>
                    
                    @if($product->description)
                        <div class="product-description mb-4">
                            <p>{!! nl2br(e($product->description)) !!}</p>
                        </div>
                    @endif
                    
                    <div class="product-actions mt-4">
                        <div class="row g-2">
                            <div class="col-md-4">
                                <div class="input-group">
                                    <button class="btn btn-outline-secondary" type="button" onclick="decrementQty()">-</button>
                                    <input type="number" class="form-control text-center" id="product-qty" value="1" min="1">
                                    <button class="btn btn-outline-secondary" type="button" onclick="incrementQty()">+</button>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <button class="btn btn-primary w-100" onclick="addToCart({{ $product->id }})">
                                    <i class="fas fa-shopping-cart me-2"></i> Add to Cart
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        @if($relatedProducts->count() > 0)
            <div class="row mt-5">
                <div class="col-12">
                    <h3 class="mb-4">Related Products</h3>
                </div>
                @foreach($relatedProducts as $related)
                    @include('site.shop.partials.product-card', ['product' => $related, 'colSize' => 3])
                @endforeach
            </div>
        @endif
    </div>
</section>
@endsection

@section('scripts')
<script>
function changeMainImage(src, element) {
    document.getElementById('main-product-image').src = src;
    document.querySelectorAll('.thumb-item').forEach(el => el.classList.remove('active'));
    element.classList.add('active');
}

function incrementQty() {
    var input = document.getElementById('product-qty');
    input.value = parseInt(input.value) + 1;
}

function decrementQty() {
    var input = document.getElementById('product-qty');
    if (parseInt(input.value) > 1) {
        input.value = parseInt(input.value) - 1;
    }
}

function addToCart(productId) {
    var qty = document.getElementById('product-qty').value;
    alert('Add to cart: Product ' + productId + ', Qty: ' + qty);
}
</script>
@endsection

@section('styles')
<style>
.thumb-gallery-vertical {
    display: flex;
    flex-direction: column;
    gap: 10px;
}
.thumb-gallery-vertical .thumb-item {
    cursor: pointer;
    border: 2px solid transparent;
    border-radius: 8px;
    overflow: hidden;
    transition: border-color 0.3s;
}
.thumb-gallery-vertical .thumb-item:hover, 
.thumb-gallery-vertical .thumb-item.active {
    border-color: var(--bs-primary);
}
.thumb-gallery-vertical .thumb-item img {
    width: 100%;
    height: auto;
}
</style>
@endsection

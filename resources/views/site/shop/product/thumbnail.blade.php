@extends('site.layouts.app')

@section('title', $product->name . ' - Pacific Plant Growers')

@php
    $price = $product->getPriceForClient($clientId ?? null);
    $placeholder = 'https://placehold.co/600x600/EEE/31343C/webp?font=oswald&text=' . urlencode($product->name);
    $thumbPlaceholder = 'https://placehold.co/100x100/EEE/31343C/webp?font=oswald&text=' . urlencode($product->name);
    $additionalColors = ['3B82F6/FFF', 'EF4444/FFF', '10B981/FFF', 'F59E0B/FFF', '8B5CF6/FFF', 'EC4899/FFF'];
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
                    {{-- Main photo thumbnail --}}
                    @if($product->is_fake || !$product->photo)
                        <div class="thumb-item active" onclick="changeMainImage('{{ $placeholder }}', this)">
                            <img src="{{ $thumbPlaceholder }}" alt="{{ $product->name }}">
                        </div>
                    @else
                        <div class="thumb-item active" onclick="changeMainImage('{{ $product->photo->product_main }}', this)">
                            <img src="{{ $product->photo->product_thumb }}" alt="{{ $product->name }}">
                        </div>
                    @endif
                    
                    {{-- Additional photos or fake placeholders --}}
                    @if($product->is_fake)
                        @for($i = 0; $i < 3; $i++)
                            @php 
                                $color = $additionalColors[$i % count($additionalColors)];
                                $fakeMain = 'https://placehold.co/600x600/' . $color . '/webp?font=oswald&text=' . urlencode($product->name . ' ' . ($i + 2));
                                $fakeThumb = 'https://placehold.co/100x100/' . $color . '/webp?font=oswald&text=' . ($i + 2);
                            @endphp
                            <div class="thumb-item" onclick="changeMainImage('{{ $fakeMain }}', this)">
                                <img src="{{ $fakeThumb }}" alt="{{ $product->name }} {{ $i + 2 }}">
                            </div>
                        @endfor
                    @elseif($product->additional_photos)
                        @foreach($product->additional_photos as $photo)
                            <div class="thumb-item" onclick="changeMainImage('{{ $photo->product_main }}', this)">
                                <img src="{{ $photo->product_thumb }}" alt="{{ $product->name }}">
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
            <div class="col-lg-5 col-md-10 m-b30 order-lg-2 order-1">
                <div class="dz-product-detail sticky-top">
                    <div class="dz-media">
                        @if($product->is_fake || !$product->photo)
                            <img src="{{ $placeholder }}" alt="{{ $product->name }}" id="main-product-image">
                        @else
                            <img src="{{ $product->photo->product_main }}" alt="{{ $product->name }}" id="main-product-image">
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
                    
                    <h2 class="title mb-3">{{ $product->name }}
                        @can('product_edit')
                            <a href="{{ route('admin.products.edit', $product) }}" target="_blank" class="btn btn-sm btn-outline-secondary ms-2" title="Edit in Admin">
                                <i class="fas fa-edit"></i>
                            </a>
                        @endcan
                    </h2>
                    
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
                            <div class="description-content">{!! $product->description !!}</div>
                        </div>
                    @endif
                    
                    {{-- Product Order Section with Variations --}}
                    @include('site.shop.partials.product-order-section', ['product' => $product, 'clientId' => $clientId ?? null])
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
</script>
@stack('scripts')
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

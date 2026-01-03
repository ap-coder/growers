@extends('site.layouts.app')

@section('title', $product->name . ' - Pacific Plant Growers')

@php
    $price = $product->getPriceForClient($clientId ?? null);
    $placeholder = 'https://placehold.co/800x600/EEE/31343C/webp?font=oswald&text=' . urlencode($product->name);
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
<section class="content-inner p-0">
    <div class="product-hero-section">
        <div class="container-fluid p-0">
            <div class="row g-0">
                <div class="col-lg-8">
                    <div class="product-hero-image">
                        @if($product->is_fake || !$product->photo)
                            <img src="{{ $placeholder }}" alt="{{ $product->name }}" class="w-100" style="max-height: 600px; object-fit: cover;">
                        @else
                            <img src="{{ $product->photo->full }}" alt="{{ $product->name }}" class="w-100" style="max-height: 600px; object-fit: cover;">
                        @endif
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="product-hero-content p-5 h-100 d-flex flex-column justify-content-center bg-light">
                        @if($product->categories->count() > 0)
                            <div class="product-category mb-2">
                                @foreach($product->categories as $category)
                                    <a href="{{ route('site.shop.index', ['category' => $category->id]) }}" class="badge bg-primary me-1">{{ $category->name }}</a>
                                @endforeach
                            </div>
                        @endif
                        
                        <h1 class="title mb-3">{{ $product->name }}
                            @can('product_edit')
                                <a href="{{ route('admin.products.edit', $product) }}" target="_blank" class="btn btn-sm btn-outline-secondary ms-2" title="Edit in Admin">
                                    <i class="fas fa-edit"></i>
                                </a>
                            @endcan
                        </h1>
                        
                        @if($product->sku)
                            <p class="text-muted mb-2"><small>SKU: {{ $product->sku }}</small></p>
                        @endif
                        
                        <div class="price-area mb-4">
                            <span class="price h2 text-primary">
                                @if($price)
                                    ${{ number_format($price, 2) }}
                                @else
                                    <span class="text-muted h4">Contact for pricing</span>
                                @endif
                            </span>
                        </div>
                        
                        @if($product->quantity !== null)
                            <div class="stock-status mb-3">
                                @if($product->quantity > 0)
                                    <span class="badge bg-success"><i class="fas fa-check me-1"></i> In Stock ({{ $product->quantity }} available)</span>
                                @else
                                    <span class="badge bg-danger"><i class="fas fa-times me-1"></i> Out of Stock</span>
                                @endif
                            </div>
                        @endif
                        
                        {{-- Product Order Section with Variations --}}
                        @include('site.shop.partials.product-order-section', ['product' => $product, 'clientId' => $clientId ?? null])
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="container py-5">
        @if($product->description)
            <div class="row mb-5">
                <div class="col-lg-8 mx-auto">
                    <h3 class="mb-4">Product Description</h3>
                    <div class="lead description-content">{!! $product->description !!}</div>
                </div>
            </div>
        @endif
        
        @if($product->is_fake || ($product->additional_photos && $product->additional_photos->count() > 0))
            <div class="row mb-5">
                <div class="col-12">
                    <h3 class="mb-4">Gallery</h3>
                </div>
                @if($product->is_fake)
                    @for($i = 0; $i < 6; $i++)
                        @php $color = $additionalColors[$i % count($additionalColors)]; @endphp
                        <div class="col-md-4 mb-4">
                            <img src="https://placehold.co/400x400/{{ $color }}/webp?font=oswald&text={{ urlencode($product->name . ' ' . ($i + 2)) }}" alt="{{ $product->name }}" class="w-100 rounded shadow-sm">
                        </div>
                    @endfor
                @else
                    @foreach($product->additional_photos as $photo)
                        <div class="col-md-4 mb-4">
                            <img src="{{ $photo->shop_card }}" alt="{{ $product->name }}" class="w-100 rounded shadow-sm">
                        </div>
                    @endforeach
                @endif
            </div>
        @endif
        
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
@stack('scripts')
@endsection

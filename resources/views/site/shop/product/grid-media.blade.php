@extends('site.layouts.app')

@section('title', $product->name . ' - Pacific Plant Growers')

@php
    $price = $product->getPriceForClient($clientId ?? null);
    $placeholder = 'https://placehold.co/600x600/EEE/31343C/webp?font=oswald&text=' . urlencode($product->name);
    $galleryPlaceholder = 'https://placehold.co/300x300/EEE/31343C/webp?font=oswald&text=' . urlencode($product->name);
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
            <div class="col-lg-7 m-b30">
                <div class="product-gallery-grid">
                    <div class="row g-3">
                        @if($product->is_fake || !$product->photo)
                            <div class="col-12">
                                <div class="gallery-item main-image">
                                    <img src="{{ $placeholder }}" alt="{{ $product->name }}" class="w-100 rounded">
                                </div>
                            </div>
                        @else
                            <div class="col-12">
                                <div class="gallery-item main-image">
                                    <img src="{{ $product->photo->product_main }}" alt="{{ $product->name }}" class="w-100 rounded">
                                </div>
                            </div>
                        @endif
                        @if($product->is_fake)
                            @for($i = 0; $i < 4; $i++)
                                @php $color = $additionalColors[$i % count($additionalColors)]; @endphp
                                <div class="col-6">
                                    <div class="gallery-item">
                                        <img src="https://placehold.co/300x300/{{ $color }}/webp?font=oswald&text={{ urlencode($product->name . ' ' . ($i + 2)) }}" alt="{{ $product->name }}" class="w-100 rounded">
                                    </div>
                                </div>
                            @endfor
                        @elseif($product->additional_photos)
                            @foreach($product->additional_photos as $photo)
                                <div class="col-6">
                                    <div class="gallery-item">
                                        <img src="{{ $photo->shop_card }}" alt="{{ $product->name }}" class="w-100 rounded">
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-lg-5 m-b30">
                <div class="dz-product-detail-content sticky-top">
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
                            <h5>Description</h5>
                            <div class="description-content">{!! $product->description !!}</div>
                        </div>
                    @endif
                    
                    @if($product->quantity !== null)
                        <div class="stock-status mb-3">
                            @if($product->quantity > 0)
                                <span class="badge bg-success"><i class="fas fa-check me-1"></i> In Stock</span>
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

@section('styles')
<style>
.gallery-item {
    overflow: hidden;
    border-radius: 8px;
}
.gallery-item img {
    transition: transform 0.3s;
}
.gallery-item:hover img {
    transform: scale(1.05);
}
</style>
@endsection

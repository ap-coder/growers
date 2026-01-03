@extends('site.layouts.app')

@section('title', $product->name . ' - Pacific Plant Growers')

@php
    $price = $product->getPriceForClient($clientId ?? null);
    $placeholder = 'https://placehold.co/600x600/EEE/31343C/webp?font=oswald&text=' . urlencode($product->name);
    $thumbPlaceholder = 'https://placehold.co/100x100/EEE/31343C/webp?font=oswald&text=' . urlencode($product->name);
    // Different colored placeholders for additional images to show they're working
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
            <div class="col-lg-6 m-b30">
                <div class="dz-product-detail sticky-top">
                    <div class="dz-media">
                        @if($product->is_fake || !$product->photo)
                            <img src="{{ $placeholder }}" alt="{{ $product->name }}" id="main-product-image">
                        @else
                            <img src="{{ $product->photo->product_main }}" alt="{{ $product->name }}" id="main-product-image" data-full="{{ $product->photo->full }}">
                        @endif
                    </div>
                    @if($product->is_fake || ($product->additional_photos && $product->additional_photos->count() > 0))
                        <div class="dz-thumb-box mt-3">
                            <div class="row g-2">
                                {{-- Main photo thumbnail --}}
                                <div class="col-3">
                                    @if($product->is_fake || !$product->photo)
                                        <div class="thumb-item active" onclick="changeMainImage('{{ $placeholder }}', this)">
                                            <img src="{{ $thumbPlaceholder }}" alt="{{ $product->name }}">
                                        </div>
                                    @else
                                        <div class="thumb-item active" onclick="changeMainImage('{{ $product->photo->product_main }}', this)">
                                            <img src="{{ $product->photo->product_thumb }}" alt="{{ $product->name }}">
                                        </div>
                                    @endif
                                </div>
                                
                                {{-- Additional photos or fake placeholders --}}
                                @if($product->is_fake)
                                    @for($i = 0; $i < 3; $i++)
                                        @php 
                                            $color = $additionalColors[$i % count($additionalColors)];
                                            $fakeMain = 'https://placehold.co/600x600/' . $color . '/webp?font=oswald&text=' . urlencode($product->name . ' ' . ($i + 2));
                                            $fakeThumb = 'https://placehold.co/100x100/' . $color . '/webp?font=oswald&text=' . ($i + 2);
                                        @endphp
                                        <div class="col-3">
                                            <div class="thumb-item" onclick="changeMainImage('{{ $fakeMain }}', this)">
                                                <img src="{{ $fakeThumb }}" alt="{{ $product->name }} {{ $i + 2 }}">
                                            </div>
                                        </div>
                                    @endfor
                                @else
                                    @foreach($product->additional_photos as $photo)
                                        <div class="col-3">
                                            <div class="thumb-item" onclick="changeMainImage('{{ $photo->product_main }}', this)">
                                                <img src="{{ $photo->product_thumb }}" alt="{{ $product->name }}">
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    @endif
                    
                    {{-- Full Description below images --}}
                    @if($product->description)
                        <div class="product-description mt-4">
                            <h5 class="m-b15">Description</h5>
                            <div class="description-content">{!! $product->description !!}</div>
                        </div>
                    @endif
                </div>
            </div>
            <div class="col-lg-6 m-b30">
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
                    
                    @if($product->excerpt)
                        <p class="para-text">{{ $product->excerpt }}</p>
                    @endif
                    
                    @if($product->quantity !== null)
                        <div class="stock-status mb-3">
                            @if($product->quantity > 0)
                                <span class="badge bg-success"><i class="fas fa-check me-1"></i> In Stock ({{ $product->quantity }} available)</span>
                            @else
                                <span class="badge bg-danger"><i class="fas fa-times me-1"></i> Out of Stock</span>
                            @endif
                        </div>
                    @endif
                    
                    @if($product->tags->count() > 0)
                        <div class="product-tags mt-4">
                            <strong>Tags:</strong>
                            @foreach($product->tags as $tag)
                                <span class="badge bg-secondary">{{ $tag->name }}</span>
                            @endforeach
                        </div>
                    @endif
                    
                    {{-- Product Order Section with Add to Cart --}}
                    @include('site.shop.partials.product-order-section', ['product' => $product, 'clientId' => $clientId ?? null])
                    
                    {{-- Accordion for Variations, Accessories, Bulk Pricing --}}
                    @php
                        $hasVariations = $product->variations()->where('published', true)->where('active', true)->count() > 0;
                        $hasAccessories = $product->show_accessories && $product->accessories->count() > 0;
                        $hasPriceTiers = $product->hasPriceTiers();
                    @endphp
                    
                    @if($hasVariations || $hasAccessories || $hasPriceTiers)
                        <div class="accordion dz-accordion accordion-sm m-b20" id="productOptionsAccordion">
                            {{-- Variations Accordion --}}
                            @if($hasVariations)
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingVariations">
                                        <a href="#" class="accordion-button" data-bs-toggle="collapse" data-bs-target="#collapseVariations" aria-expanded="true" aria-controls="collapseVariations">
                                            Product Options
                                            <span class="toggle-close"></span>
                                        </a>
                                    </h2>
                                    <div id="collapseVariations" class="accordion-collapse collapse show" aria-labelledby="headingVariations" data-bs-parent="#productOptionsAccordion">
                                        <div class="accordion-body p-0">
                                            @include('site.shop.partials.product-variations-content', ['product' => $product, 'clientId' => $clientId ?? null])
                                        </div>
                                    </div>
                                </div>
                            @endif
                            
                            {{-- Accessories Accordion - One per Type --}}
                            @if($hasAccessories)
                                @php
                                    $accessoriesByType = $product->getAccessoriesByType();
                                @endphp
                                @foreach($accessoriesByType as $typeName => $typeAccessories)
                                    @php
                                        $typeSlug = \Illuminate\Support\Str::slug($typeName);
                                    @endphp
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="heading{{ $typeSlug }}">
                                            <a href="#" class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#collapse{{ $typeSlug }}" aria-expanded="false" aria-controls="collapse{{ $typeSlug }}">
                                                {{ $typeName }}
                                                <span class="toggle-close"></span>
                                            </a>
                                        </h2>
                                        <div id="collapse{{ $typeSlug }}" class="accordion-collapse collapse" aria-labelledby="heading{{ $typeSlug }}" data-bs-parent="#productOptionsAccordion">
                                            <div class="accordion-body p-0">
                                                @include('site.shop.partials.product-accessory-type-content', ['typeAccessories' => $typeAccessories, 'clientId' => $clientId ?? null])
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                            
                            {{-- Bulk Pricing Accordion --}}
                            @if($hasPriceTiers)
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingPricing">
                                        <a href="#" class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#collapsePricing" aria-expanded="false" aria-controls="collapsePricing">
                                            Bulk Pricing
                                            <span class="toggle-close"></span>
                                        </a>
                                    </h2>
                                    <div id="collapsePricing" class="accordion-collapse collapse" aria-labelledby="headingPricing" data-bs-parent="#productOptionsAccordion">
                                        <div class="accordion-body p-0">
                                            @include('site.shop.partials.product-price-tiers-content', ['product' => $product, 'clientId' => $clientId ?? null])
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    @endif
                    
                    {{-- Running Total Section --}}
                    <hr class="m-t15 m-b15">
                    <div class="order-total d-flex justify-content-between align-items-center p-3 bg-light rounded">
                        <span class="fw-bold">Current Total:</span>
                        <span class="h5 mb-0 text-primary" id="running-total">$0.00</span>
                    </div>
                    <hr class="m-t15 m-b20">
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
.thumb-item {
    cursor: pointer;
    border: 2px solid transparent;
    border-radius: 8px;
    overflow: hidden;
    transition: border-color 0.3s;
}
.thumb-item:hover, .thumb-item.active {
    border-color: var(--bs-primary);
}
.thumb-item img {
    width: 100%;
    height: auto;
}
</style>
@endsection

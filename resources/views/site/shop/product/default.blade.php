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
                </div>
            </div>
            <div class="col-lg-6 m-b30">
                <div class="dz-product-detail-content">
                    @if($product->categories->count() > 0)
                        <div class="product-category mb-2">
                            @foreach($product->categories as $category)
                                <a href="{{ route('site.shop.index', ['category' => $category->id]) }}" class="badge bg-secondary text-white me-1">{{ $category->name }}</a>
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
                        <p class="mb-2"><small>SKU: {{ $product->sku }}</small></p>
                    @endif
                    
                    <div class="meta-content m-b20">
                        <span class="form-label">Price</span>
                        <span class="price">
                            @if($price)
                                ${{ number_format($price, 2) }}
                                @if($product->show_original_price && $product->full_price && $product->full_price > $price)
                                    <del>${{ number_format($product->full_price, 2) }}</del>
                                @endif
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
                    
                    {{-- Tags at bottom --}}
                    @if($product->tags->count() > 0)
                        <div class="product-tags mt-3">
                            <strong>Tags:</strong>
                            @foreach($product->tags as $tag)
                                <a href="{{ route('site.shop.index', ['tag' => $tag->id]) }}" class="badge bg-secondary text-decoration-none">{{ $tag->name }}</a>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
        
        {{-- Product Description Tabs --}}
        @php
            // Check individual tab settings (default to true if null for backward compatibility)
            $showDescTab = ($product->show_description_tab ?? true) && $product->description;
            $showInfoTab = ($product->show_additional_info_tab ?? true) && $product->additional_info;
            $showShipTab = ($product->show_shipping_return_tab ?? true) && $product->shipping_return;
            $hasAnyTab = $showDescTab || $showInfoTab || $showShipTab;
            $firstTab = $showDescTab ? 'description' : ($showInfoTab ? 'information' : 'return');
        @endphp
        
        @if(($product->show_tabs ?? true) && $hasAnyTab)
            <section class="content-inner-3 pb-0">
                <div class="product-description">
                    <div class="dz-tabs">
                        <ul class="nav nav-tabs center" id="productTabs" role="tablist">
                                @if($showDescTab)
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link {{ $firstTab === 'description' ? 'active' : '' }}" id="description-tab" data-bs-toggle="tab" data-bs-target="#description-tab-pane" type="button" role="tab" aria-controls="description-tab-pane" aria-selected="{{ $firstTab === 'description' ? 'true' : 'false' }}">
                                            Description
                                        </button>
                                    </li>
                                @endif
                                @if($showInfoTab)
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link {{ $firstTab === 'information' ? 'active' : '' }}" id="information-tab" data-bs-toggle="tab" data-bs-target="#information-tab-pane" type="button" role="tab" aria-controls="information-tab-pane" aria-selected="{{ $firstTab === 'information' ? 'true' : 'false' }}">
                                            Additional Information
                                        </button>
                                    </li>
                                @endif
                                @if($showShipTab)
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link {{ $firstTab === 'return' ? 'active' : '' }}" id="return-tab" data-bs-toggle="tab" data-bs-target="#return-tab-pane" type="button" role="tab" aria-controls="return-tab-pane" aria-selected="{{ $firstTab === 'return' ? 'true' : 'false' }}">
                                            Shipping & Return
                                        </button>
                                    </li>
                                @endif
                            </ul>
                            <div class="tab-content" id="productTabsContent">
                                @if($showDescTab)
                                    <div class="tab-pane fade {{ $firstTab === 'description' ? 'show active' : '' }}" id="description-tab-pane" role="tabpanel" aria-labelledby="description-tab" tabindex="0">
                                        <div class="detail-bx article-content">
                                            {!! $product->description !!}
                                        </div>
                                    </div>
                                @endif
                                @if($showInfoTab)
                                    <div class="tab-pane fade {{ $firstTab === 'information' ? 'show active' : '' }}" id="information-tab-pane" role="tabpanel" aria-labelledby="information-tab" tabindex="0">
                                        <div class="detail-bx article-content">
                                            {!! $product->additional_info !!}
                                        </div>
                                    </div>
                                @endif
                                @if($showShipTab)
                                    <div class="tab-pane fade {{ $firstTab === 'return' ? 'show active' : '' }}" id="return-tab-pane" role="tabpanel" aria-labelledby="return-tab" tabindex="0">
                                        <div class="detail-bx article-content">
                                            {!! $product->shipping_return !!}
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        @endif
    </div>
</section>

{{-- Related Products Section --}}
@if($relatedProducts->count() > 0)
    <section class="content-inner-1 overflow-hidden">
        <div class="container">
            <div class="section-head style-5 d-md-flex align-items-center justify-content-between">
                <div class="left-content">
                    <h2 class="title mb-0">Related products</h2>
                </div>
                <a href="{{ route('site.shop.index') }}" class="text-secondary font-14 d-flex align-items-center gap-1">See all products
                    <i class="icon feather icon-chevron-right font-18"></i>
                </a>
            </div>
            <div class="swiper-btn-center-lr">
                <div class="swiper swiper-four">
                    <div class="swiper-wrapper">
                        @foreach($relatedProducts as $related)
                            <div class="swiper-slide">
                                <div class="shop-card">
                                    <div class="dz-media">
                                        @if($related->is_fake || !$related->photo)
                                            <img src="https://placehold.co/300x300/EEE/31343C/webp?font=oswald&text={{ urlencode($related->name) }}" alt="{{ $related->name }}">
                                        @else
                                            <img src="{{ $related->photo->shop_card }}" alt="{{ $related->name }}">
                                        @endif
                                        <div class="shop-meta">
                                            <div class="btn btn-primary meta-icon dz-wishicon add-to-wishlist" data-product-id="{{ $related->id }}">
                                                <i class="icon feather icon-heart dz-heart"></i>
                                                <i class="icon feather icon-heart-on dz-heart-fill"></i>
                                            </div>
                                            <a href="javascript:void(0);" class="btn btn-primary meta-icon dz-wishicon" onclick="window.location='{{ route('site.shop.product', $related) }}'">
                                                <i class="flaticon flaticon-eye d-md-none d-block"></i>
                                                <span class="d-md-block d-none"><i class="flaticon flaticon-eye"></i></span>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="dz-content">
                                        <h2 class="title"><a href="{{ route('site.shop.product', $related) }}">{{ $related->name }}</a></h2>
                                        <span class="price">
                                            @php
                                                $relatedPrice = $related->getPriceForClient($clientId ?? null);
                                            @endphp
                                            @if($relatedPrice)
                                                ${{ number_format($relatedPrice, 2) }}
                                                @if($related->show_original_price && $related->full_price && $related->full_price > $relatedPrice)
                                                    <del>${{ number_format($related->full_price, 2) }}</del>
                                                @endif
                                            @endif
                                        </span>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="swiper-button-prev swiper-button-white"><i class="fa-solid fa-arrow-left"></i></div>
                <div class="swiper-button-next swiper-button-white"><i class="fa-solid fa-arrow-right"></i></div>
            </div>
        </div>
    </section>
@endif
@endsection

@section('scripts')
<script>
function changeMainImage(src, element) {
    document.getElementById('main-product-image').src = src;
    document.querySelectorAll('.thumb-item').forEach(el => el.classList.remove('active'));
    element.classList.add('active');
}

// Initialize Swiper for related products
document.addEventListener('DOMContentLoaded', function() {
    var swiperFour = new Swiper('.swiper-four', {
        slidesPerView: 4,
        spaceBetween: 30,
        loop: true,
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
        breakpoints: {
            320: {
                slidesPerView: 1,
                spaceBetween: 15,
            },
            576: {
                slidesPerView: 2,
                spaceBetween: 20,
            },
            768: {
                slidesPerView: 3,
                spaceBetween: 25,
            },
            1024: {
                slidesPerView: 4,
                spaceBetween: 30,
            }
        }
    });
});
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

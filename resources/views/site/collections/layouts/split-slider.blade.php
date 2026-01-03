@extends('site.layouts.app')

@section('title', $collection->name . ' - Pacific Plant Growers')

@section('content')
<div class="page-content">
    <section class="pt-0 z-index-unset bg-white overflow-hidden">
        <div class="container-fluid">
            <div class="d-sm-flex justify-content-sm-between justtify-content-center py-sm-3 py-3 mb-sm-0 m-b20">
                <nav aria-label="breadcrumb" class="breadcrumb-row">
                    <ul class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="{{ route('frontend.home') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('site.shop.index') }}">Shop</a></li>
                        <li class="breadcrumb-item active">{{ $collection->name }}</li>
                    </ul>
                </nav>
            </div>
        </div>
        
        <div class="dz-split-slider">
            <div class="swiper portfolio-split-slider">
                <div class="swiper-wrapper">
                    @foreach($products as $product)
                    @php
                        $placeholder = 'https://placehold.co/600x400/EEEEEE/000000?text=' . urlencode($product->name);
                    @endphp
                    <div class="swiper-slide">
                        <div class="split-box">
                            <div class="row g-0">
                                <div class="col-lg-6">
                                    <div class="split-media">
                                        <a href="{{ route('site.shop.product', $product->slug ?? $product->id) }}">
                                            @if($product->is_fake || !$product->hasMedia('images'))
                                                <img src="{{ $placeholder }}" alt="{{ $product->name }}">
                                            @else
                                                <img src="{{ $product->getFirstMediaUrl('images', 'large') }}" alt="{{ $product->name }}">
                                            @endif
                                        </a>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="split-content">
                                        @if($product->categories->count() > 0)
                                        <div class="product-tag mb-3">
                                            <span class="badge badge-primary">{{ $product->categories->first()->name }}</span>
                                        </div>
                                        @endif
                                        <h2 class="title mb-3">{{ $product->name }}</h2>
                                        @if($product->description)
                                        <p class="text-muted mb-4">{{ Str::limit($product->description, 200) }}</p>
                                        @endif
                                        <a href="{{ route('site.shop.product', $product->slug ?? $product->id) }}" class="btn btn-primary">View Product</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            <div class="split-slider-nav">
                <div class="split-button-prev swiper-button-prev"><i class="fas fa-arrow-left"></i></div>
                <div class="split-button-next swiper-button-next"><i class="fas fa-arrow-right"></i></div>
            </div>
            <div class="swiper-pagination split-pagination"></div>
        </div>
        
        @if($collection->description)
        <div class="container mt-4">
            <p class="text-muted text-center">{{ $collection->description }}</p>
        </div>
        @endif
    </section>
</div>
@endsection

@section('scripts')
@parent
<script>
$(document).ready(function() {
    if (typeof Swiper !== 'undefined') {
        new Swiper('.portfolio-split-slider', {
            slidesPerView: 1,
            spaceBetween: 0,
            loop: true,
            effect: 'fade',
            fadeEffect: {
                crossFade: true
            },
            navigation: {
                nextEl: '.split-button-next',
                prevEl: '.split-button-prev',
            },
            pagination: {
                el: '.split-pagination',
                clickable: true,
            },
        });
    }
});
</script>
@endsection

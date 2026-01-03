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
        
        @if($collection->description)
        <div class="container mb-4">
            <h2 class="text-center">{{ $collection->name }}</h2>
            <p class="text-muted text-center">{{ $collection->description }}</p>
        </div>
        @endif
        
        <div class="container">
            <div class="portfolio-thumbs-wrapper">
                <!-- Main Slider -->
                <div class="swiper portfolio-thumbs-main">
                    <div class="swiper-wrapper">
                        @foreach($products as $product)
                        @php
                            $placeholder = 'https://placehold.co/600x400/EEEEEE/000000?text=' . urlencode($product->name);
                        @endphp
                        <div class="swiper-slide">
                            <div class="portfolio-box style-2">
                                <div class="dz-media">
                                    <a href="{{ route('site.shop.product', $product->slug ?? $product->id) }}">
                                        @if($product->is_fake || !$product->hasMedia('images'))
                                            <img src="{{ $placeholder }}" alt="{{ $product->name }}">
                                        @else
                                            <img src="{{ $product->getFirstMediaUrl('images', 'large') }}" alt="{{ $product->name }}">
                                        @endif
                                    </a>
                                </div>
                                <div class="dz-content">
                                    @if($product->categories->count() > 0)
                                    <div class="product-tag">
                                        <span class="badge">{{ $product->categories->first()->name }}</span>
                                    </div>
                                    @endif
                                    <h2 class="title"><a href="{{ route('site.shop.product', $product->slug ?? $product->id) }}">{{ $product->name }}</a></h2>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <div class="swiper-button-next thumbs-next"></div>
                    <div class="swiper-button-prev thumbs-prev"></div>
                </div>
                
                <!-- Thumbs Slider -->
                <div class="swiper portfolio-thumbs-nav mt-3">
                    <div class="swiper-wrapper">
                        @foreach($products as $product)
                        @php
                            $thumbPlaceholder = 'https://placehold.co/100x100/EEEEEE/000000?text=' . urlencode(Str::limit($product->name, 10));
                        @endphp
                        <div class="swiper-slide">
                            <div class="thumb-item">
                                @if($product->is_fake || !$product->hasMedia('images'))
                                    <img src="{{ $thumbPlaceholder }}" alt="{{ $product->name }}">
                                @else
                                    <img src="{{ $product->getFirstMediaUrl('images', 'thumb') }}" alt="{{ $product->name }}">
                                @endif
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection

@section('scripts')
@parent
<script>
$(document).ready(function() {
    if (typeof Swiper !== 'undefined') {
        var thumbsSwiper = new Swiper('.portfolio-thumbs-nav', {
            slidesPerView: 4,
            spaceBetween: 10,
            watchSlidesProgress: true,
            breakpoints: {
                320: {
                    slidesPerView: 3,
                },
                576: {
                    slidesPerView: 4,
                },
                992: {
                    slidesPerView: 5,
                },
                1200: {
                    slidesPerView: 6,
                },
            }
        });
        
        new Swiper('.portfolio-thumbs-main', {
            slidesPerView: 1,
            spaceBetween: 0,
            loop: true,
            navigation: {
                nextEl: '.thumbs-next',
                prevEl: '.thumbs-prev',
            },
            thumbs: {
                swiper: thumbsSwiper,
            },
        });
    }
});
</script>
@endsection

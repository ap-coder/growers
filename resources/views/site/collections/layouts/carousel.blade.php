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
                <div class="pagination-align style-2">
                    <div class="portfolio-button-prev swiper-button-prev">Prev</div>
                    <div class="portfolio-button-next swiper-button-next">Next</div>
                </div>
            </div>
        </div>
        
        <div class="container-fluid">
            <div class="swiper portfolio-gallery3">
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
                                    <a href="{{ route('site.shop.index', ['category' => $product->categories->first()->slug]) }}">
                                        <span class="badge">{{ $product->categories->first()->name }}</span>
                                    </a>
                                </div>
                                @endif
                                <h2 class="title"><a href="{{ route('site.shop.product', $product->slug ?? $product->id) }}">{{ $product->name }}</a></h2>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="swiper-pagination-two"></div>
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
        new Swiper('.portfolio-gallery3', {
            slidesPerView: 3,
            spaceBetween: 30,
            loop: true,
            navigation: {
                nextEl: '.portfolio-button-next',
                prevEl: '.portfolio-button-prev',
            },
            pagination: {
                el: '.swiper-pagination-two',
                clickable: true,
            },
            breakpoints: {
                320: {
                    slidesPerView: 1,
                    spaceBetween: 10,
                },
                576: {
                    slidesPerView: 2,
                    spaceBetween: 20,
                },
                992: {
                    slidesPerView: 3,
                    spaceBetween: 30,
                },
            }
        });
    }
});
</script>
@endsection

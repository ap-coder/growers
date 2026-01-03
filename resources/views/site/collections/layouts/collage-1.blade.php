@extends('site.layouts.app')

@section('title', $collection->name . ' - Pacific Plant Growers')

@section('banner')
<div class="dz-bnr-inr" style="background-image:url({{ asset('site/images/background/bg1.jpg') }});">
    <div class="container">
        <div class="dz-bnr-inr-entry">
            <h1>{{ $collection->name }}</h1>
            <nav aria-label="breadcrumb" class="breadcrumb-row">
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('frontend.home') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('site.shop.index') }}">Shop</a></li>
                    <li class="breadcrumb-item active">{{ $collection->name }}</li>
                </ul>
            </nav>
        </div>
    </div>
</div>
@endsection

@section('content')
<section class="content-inner pt-0 z-index-unset">
    @if($collection->description)
    <div class="container mb-4">
        <p class="text-muted text-center">{{ $collection->description }}</p>
    </div>
    @endif
    
    <div class="container">
        <div class="row dz-gallery-box style-1">
            @foreach($products as $index => $product)
            @php
                $placeholder = 'https://placehold.co/600x400/EEEEEE/000000?text=' . urlencode($product->name);
                // Collage style 1: alternating large/small pattern
                $isLarge = ($index % 4 == 0 || $index % 4 == 3);
                $colClass = $isLarge ? 'col-lg-8' : 'col-lg-4';
            @endphp
            <div class="{{ $colClass }} col-md-6 m-b30">
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
</section>
@endsection

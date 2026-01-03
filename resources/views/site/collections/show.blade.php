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
<section class="content-inner-3 pt-3">
    <div class="container">
        @if($collection->description)
            <div class="row mb-4">
                <div class="col-12">
                    <p class="text-muted">{{ $collection->description }}</p>
                </div>
            </div>
        @endif
        
        <div class="row">
            @forelse($products as $product)
                <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 m-b30">
                    <div class="dz-shop-card style-1">
                        <div class="dz-media">
                            <a href="{{ route('site.shop.product', $product->slug ?? $product->id) }}">
                                @if($product->hasMedia('images'))
                                    <img src="{{ $product->getFirstMediaUrl('images', 'thumb') }}" alt="{{ $product->name }}">
                                @else
                                    <img src="{{ asset('site/images/shop/product/pic1.jpg') }}" alt="{{ $product->name }}">
                                @endif
                            </a>
                        </div>
                        <div class="dz-content">
                            <h5 class="title">
                                <a href="{{ route('site.shop.product', $product->slug ?? $product->id) }}">{{ $product->name }}</a>
                            </h5>
                            @auth
                                @php
                                    $clientId = auth()->user()->client_id ?? null;
                                    $price = $product->getPriceForClient($clientId);
                                @endphp
                                @if($price)
                                    <span class="price">${{ number_format($price, 2) }}</span>
                                @endif
                            @endauth
                        </div>
                        <div class="product-tag">
                            <span class="badge badge-secondary">{{ $collection->layout_name }}</span>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="alert alert-info text-center py-5">
                        <i class="fas fa-info-circle fa-2x mb-3"></i>
                        <h5>No products in this collection</h5>
                        <p class="mb-0">Check back later for new additions.</p>
                    </div>
                </div>
            @endforelse
        </div>
    </div>
</section>
@endsection

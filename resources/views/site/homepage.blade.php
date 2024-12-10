@extends('site.layouts.site')

@section('title', 'Home')

@section('content')
<div class="container">
    <div class="hero-section">
        <div class="row">
            <div class="col-lg-6">
                <h1>Welcome to PlantZone</h1>
                <p>Explore a world of beautiful plants and bring nature into your home with our curated collections.</p>
                <a href="{{ url('/shop') }}" class="btn btn-primary">Shop Now</a>
            </div>
            <div class="col-lg-6">
                <img src="{{ asset('assets/images/hero-banner.png') }}" alt="PlantZone Banner">
            </div>
        </div>
    </div>
    <div class="featured-products mt-5">
        <h2>Featured Products</h2>
        <div class="row">
            <div class="col-md-4">
                <div class="product-item">
                    <img src="{{ asset('assets/images/product-1.jpg') }}" alt="Product 1">
                    <h3>Beautiful Orchid</h3>
                    <p>$25.00</p>
                    <a href="{{ url('/shop/product/1') }}" class="btn btn-secondary">View Product</a>
                </div>
            </div>
            <div class="col-md-4">
                <div class="product-item">
                    <img src="{{ asset('assets/images/product-2.jpg') }}" alt="Product 2">
                    <h3>Succulent Collection</h3>
                    <p>$18.00</p>
                    <a href="{{ url('/shop/product/2') }}" class="btn btn-secondary">View Product</a>
                </div>
            </div>
            <div class="col-md-4">
                <div class="product-item">
                    <img src="{{ asset('assets/images/product-3.jpg') }}" alt="Product 3">
                    <h3>Mini Bonsai Tree</h3>
                    <p>$30.00</p>
                    <a href="{{ url('/shop/product/3') }}" class="btn btn-secondary">View Product</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@extends('site.layouts.site')

@section('title', 'About Us')

@section('content')
<div class="container">
    <div class="about-section">
        <div class="row">
            <div class="col-lg-6">
                <h1>About PlantZone</h1>
                <p>At PlantZone, we are passionate about bringing greenery into your home and life. Our curated collection of plants is designed to bring beauty, tranquility, and nature to your space.</p>
                <p>We started our journey with a simple mission: to connect people with nature in an easy and accessible way. Today, we are proud to offer a variety of indoor and outdoor plants, along with the tools and knowledge needed to care for them.</p>
                <a href="{{ url('/shop') }}" class="btn btn-primary">Explore Our Collection</a>
            </div>
            <div class="col-lg-6">
                <img src="{{ asset('assets/images/about-us.jpg') }}" alt="About PlantZone">
            </div>
        </div>
    </div>
    <div class="our-story mt-5">
        <h2>Our Story</h2>
        <p>Founded in 2020, PlantZone has grown from a small local nursery to an online community dedicated to plant enthusiasts. We believe that plants have the power to transform environments, improve mental well-being, and connect people to nature.</p>
        <p>Whether you are a seasoned gardener or just starting out, PlantZone offers everything you need to create your green oasis. From tropical plants to succulents, our goal is to provide you with a joyful experience as you cultivate your personal green space.</p>
    </div>
</div>
@endsection

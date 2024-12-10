@extends('site.layouts.site')

@section('title', 'What We Do')

@section('content')
<div class="container">
    <div class="what-we-do-section">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h1 class="mb-4">What We Do</h1>
                <p class="lead">At PlantZone, our mission is to make the world greener by offering a wide variety of plants and gardening accessories. We help you build your personal oasis, whether you are a gardening expert or a beginner.</p>
            </div>
        </div>
        <div class="services mt-5">
            <div class="row">
                <div class="col-md-4 text-center">
                    <div class="service-item">
                        <img src="{{ asset('assets/images/service-1.jpg') }}" alt="Service 1" class="mb-3">
                        <h3>Home Gardening</h3>
                        <p>Our home gardening kits make it easy for you to bring nature indoors, no matter how much space you have.</p>
                    </div>
                </div>
                <div class="col-md-4 text-center">
                    <div class="service-item">
                        <img src="{{ asset('assets/images/service-2.jpg') }}" alt="Service 2" class="mb-3">
                        <h3>Outdoor Landscaping</h3>
                        <p>Transform your outdoor spaces into stunning green landscapes with our expert landscaping solutions.</p>
                    </div>
                </div>
                <div class="col-md-4 text-center">
                    <div class="service-item">
                        <img src="{{ asset('assets/images/service-3.jpg') }}" alt="Service 3" class="mb-3">
                        <h3>Plant Care Guides</h3>
                        <p>Learn how to take care of your plants with our easy-to-follow plant care guides and support materials.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection